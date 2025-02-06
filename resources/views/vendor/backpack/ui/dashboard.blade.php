@extends(backpack_view('blank'))

@php
    use App\Models\Complaint;
    use App\Models\Message;
    use App\Models\User;

    // 📊 Complaint Stats
    $totalComplaints = Complaint::count();
    $pendingComplaints = Complaint::where('status', 'pending')->count();
    $resolvedComplaints = Complaint::where('status', 'treated')->count();
    $canceledComplaints = Complaint::where('status', 'cancelled')->count();
    $progress = $totalComplaints > 0 ? round(($resolvedComplaints / $totalComplaints) * 100) : 0;

    // 📩 Unread Messages
    $unreadMessages = Message::whereNull('read_at')->where('user_id', '!=', auth()->id())->count();

    // 👤 User Roles Count
    $totalUsers = User::count();
    $technicians = User::where('user_type', 2)->count();
    $clients = User::where('user_type', 0)->count();

    $widgets['before_content'][] = [
        'type'    => 'div',
        'class'   => 'container',
        'content' => [

            // **ROW 1 - Complaints Progress**
            [
                'type'       => 'div',
                'class'      => 'row mb-3',
                'content'    => [
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-12',
                        'content'     => [
                            'header' => '📊 Complaints Resolution Progress',
                            'body'   => "
                                <p>Tracking resolved complaints over total complaints.</p>
                                <div class='progress' style='height: 20px;'>
                                    <div class='progress-bar bg-success' role='progressbar' style='width: {$progress}%; font-weight: bold;' aria-valuenow='{$progress}' aria-valuemin='0' aria-valuemax='100'>
                                        {$progress}%
                                    </div>
                                </div>
                                <p class='text-muted mt-2'>Goal: 100% resolution rate</p>
                            "
                        ]
                    ]
                ]
            ],

            // **ROW 2 - Complaint Breakdown (3 columns)**
            [
                'type'       => 'div',
                'class'      => 'row mb-3',
                'content'    => [
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '📋 Total Complaints',
                            'body'   => "<h3>{$totalComplaints}</h3><p>Complaints submitted</p>",
                        ]
                    ],
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '🕒 Pending Complaints',
                            'body'   => "<h3>{$pendingComplaints}</h3><p>Still unresolved</p>",
                        ]
                    ],
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '✅ Resolved Complaints',
                            'body'   => "<h3>{$resolvedComplaints}</h3><p>Successfully treated</p>",
                        ]
                    ],
                ]
            ],

            // **ROW 3 - Cancelled & Unread Messages (2 columns)**
            [
                'type'       => 'div',
                'class'      => 'row mb-3',
                'content'    => [
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-6',
                        'content'     => [
                            'header' => '❌ Cancelled Complaints',
                            'body'   => "<h3>{$canceledComplaints}</h3><p>Rejected or closed</p>",
                        ]
                    ],
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-6',
                        'content'     => [
                            'header' => '📩 Unread Messages',
                            'body'   => "<h3>{$unreadMessages}</h3><p>Messages awaiting response</p>",
                            'footer' => "<a href='" . backpack_url('messages') . "' class='btn btn-primary btn-sm'>Go to Messages</a>",
                        ]
                    ],
                ]
            ],

            // **ROW 4 - Users Overview (3 columns)**
            [
                'type'       => 'div',
                'class'      => 'row mb-3',
                'content'    => [
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '👥 Total Users',
                            'body'   => "<h3>{$totalUsers}</h3><p>Registered users</p>",
                        ]
                    ],
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '🛠️ Technicians',
                            'body'   => "<h3>{$technicians}</h3><p>Handling complaints</p>",
                        ]
                    ],
                    [
                        'type'        => 'card',
                        'wrapperClass' => 'col-md-4',
                        'content'     => [
                            'header' => '👤 Clients',
                            'body'   => "<h3>{$clients}</h3><p>Submitting complaints</p>",
                        ]
                    ]
                ]
            ],
        ]
    ];
@endphp

@section('content')
@endsection
