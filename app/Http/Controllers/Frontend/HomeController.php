<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AgentReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        $reviews = collect();

        try {
            if (Schema::hasTable('agent_reviews')) {
                $reviews = AgentReview::query()
                    ->with(['user:id,fullname', 'agent:id'])
                    ->where('is_approved', true)
                    ->whereNotNull('review')
                    ->latest()
                    ->take(7)
                    ->get();
            }
        } catch (Throwable $e) {
            // Keep homepage functional even if DB is unavailable in local/staging env.
            $reviews = collect();
        }

        $fallbackTestimonials = [
            [
                'name' => 'Sneha Patel',
                'service' => 'Policy Purchase',
                'review' => 'Found the perfect health insurance through PadosiAgent. The agent was professional and explained everything clearly.',
                'rating' => 5,
            ],
            [
                'name' => 'Rahul Verma',
                'service' => 'Claim Assistance',
                'review' => 'My claim was rejected initially, but the agent from PadosiAgent helped me get it approved. Highly recommended!',
                'rating' => 5,
            ],
            [
                'name' => 'Anjali Desai',
                'service' => 'Policy Review',
                'review' => 'Got my policy reviewed and discovered I was overpaying. Saved annual premium significantly. Thank you PadosiAgent!',
                'rating' => 5,
            ],
            [
                'name' => 'Vikram Singh',
                'service' => 'Policy Purchase',
                'review' => 'Bought term insurance for my family. The agent was patient and helped me understand all the terms.',
                'rating' => 5,
            ],
        ];

        $testimonials = $reviews->isNotEmpty()
            ? $reviews->map(function (AgentReview $review) {
                return [
                    'name' => $review->user->fullname ?? 'Verified User',
                    'service' => 'Verified Review',
                    'review' => trim((string) $review->review),
                    'rating' => max(1, min(5, (int) round($review->rating ?: 5))),
                ];
            })->values()->all()
            : $fallbackTestimonials;

        return view('index', compact('testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        return view('faq');
    }

    public function findAgents(Request $request)
    {
        $query = \App\Models\Agent::query()->with([
            'profile',
            'insuranceSegments',
            'performanceStats',
            'activeSubscription',
            'reviews' => function($q) {
                $q->where('is_approved', true);
            }
        ])
        ->whereHas('user', function($q) {
            $q->where('role', 'agent');
        });

        // Mapping of frontend readable names to DB segment types
        $typeMapping = [
            'Health Insurance' => 'health',
            'Health' => 'health',
            'Life Insurance' => 'life',
            'Life' => 'life',
            'Motor Insurance' => 'motor',
            'Motor' => 'motor',
            'SME Insurance' => 'sme',
            'SME' => 'sme',
            'Travel Insurance' => 'travel',
            'Travel' => 'travel',
            'Fire Insurance' => 'fire',
            'Fire' => 'fire',
            'Marine Insurance' => 'marine',
            'Marine' => 'marine',
            'Liability Insurance' => 'liability',
            'Liability' => 'liability',
            'Other General Insurance' => 'other',
            'Transport' => 'transport',
            'Workmen Compensation' => 'workmen_compensation',
            'GPA / GMC' => 'gpa_gmc',
            'Group Term Insurance' => 'group_term',
            'Cyber' => 'cyber'
        ];

        // Filter by Insurance Type (Segment)
        if ($request->filled('InsuranceType')) {
            $types = (array) $request->InsuranceType;
            $dbTypes = array_map(function($type) use ($typeMapping) {
                return $typeMapping[$type] ?? strtolower(str_replace(' Insurance', '', $type));
            }, $types);

            $query->whereHas('insuranceSegments', function($q) use ($dbTypes) {
                $q->whereIn('segment_type', $dbTypes);
            });
        }

        // Filter by Service Type (Lead Preferences)
        if ($request->filled('ServiceType')) {
            $serviceType = $request->ServiceType;
            $query->whereHas('leadPreferences', function($q) use ($serviceType) {
                if ($serviceType === 'New Policy') {
                    $q->where('leads_new_business', 1);
                } elseif ($serviceType === 'Claim Assistance') {
                    $q->where('leads_claims_support', 1);
                } elseif ($serviceType === 'Policy Review') {
                    $q->where('leads_portfolio_analysis', 1);
                }
            });
        }

        // Filter by City/State (from profile)
        if ($request->filled('location')) {
            $location = $request->location;
            $query->whereHas('profile', function($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('state', 'like', "%{$location}%");
            });
        }

        // Filter by Insurance Company
        if ($request->filled('InsuranceCompany') && $request->ServiceType !== 'New Policy') {
            $companyName = $request->InsuranceCompany;
            $insuranceType = $request->InsuranceType;
            
            $query->whereHas('portfolios', function($q) use ($companyName, $insuranceType, $typeMapping) {
                // If a specific insurance type (segment) is selected, narrow the company search to that segment
                if ($insuranceType) {
                    $types = (array) $insuranceType;
                    $dbTypes = array_map(function($type) use ($typeMapping) {
                        return $typeMapping[$type] ?? strtolower(str_replace(' Insurance', '', $type));
                    }, $types);
                    
                    $q->whereIn('segment_type', $dbTypes);
                }

                $q->where(function($sq) use ($companyName) {
                    $sq->where('primary_companies->name', $companyName)
                       ->orWhere('secondary_companies->name', $companyName);
                });
            });
        }

        // Generic Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('city', 'like', "%{$search}%")
                        ->orWhere('state', 'like', "%{$search}%");
                  });
            });
        }

        $agents = $query->orderBy('created_at', 'desc')->paginate(5);
        $agents->appends($request->all());

        // Check if this is specifically a pagination request (infinite scroll/load more)
        if ($request->header('HX-Request') && $request->header('HX-Target') == 'load-more-wrapper') {
            // We return a wrapper to avoid inheriting the body's hx-select
            return view('partials.agents-list-chunk', compact('agents'));
        }

        return view('find-agents', compact('agents'));
    }
}
