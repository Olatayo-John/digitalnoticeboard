<?php

return [
    'status' => [
        [
            'name' => 'Active',
            'value' => '1',
            'class' => 'bg-success'
        ], [
            'name' => 'Inactive',
            'value' => '0',
            'class' => 'bg-danger'
        ]
    ],

    'priority' => [
        [
            'name' => 'Low',
            'value' => '1',
            'class' => 'text-dark'
        ], [
            'name' => 'Medium',
            'value' => '2',
            'class' => 'text-warning'
        ], [
            'name' => 'High',
            'value' => '3',
            'class' => 'text-danger'
        ]
    ],

    'project_status' => [
        [
            'name' => 'Not started',
            'value' => '1',
            'class' => 'bg-dark'
        ], [
            'name' => 'In progress',
            'value' => '2',
            'class' => 'bg-primary'
        ], [
            'name' => 'Hold',
            'value' => '3',
            'class' => 'bg-warning'
        ], [
            'name' => 'Testing',
            'value' => '4',
            'class' => 'bg-dark'
        ], [
            'name' => 'Complete',
            'value' => '5',
            'class' => 'bg-success'
        ], [
            'name' => 'Done',
            'value' => '6',
            'class' => 'bg-success'
        ]
    ], 'project_type' => [
        [
            'name' => 'Testing',
            'value' => '1'
        ], [
            'name' => 'Production',
            'value' => '2'
        ]
    ],

    'image_instructions' => [
        '*allowed file types - jpg, jpeg, png',
        '*max file size - 2MB',
    ],
    'resume_instructions' => [
        '*allowed file types - jpg, jpeg, png, pdf, doc, docx',
        '*max file size - 2MB',
    ],
    'project_instructions' => [
        '*allowed file types - jpg, jpeg, png, doc, docx, xls, xlsx, pdf',
        '*max file size - 2MB',
    ],
    'password_instructions' => [
        '*at least 12 characters long',
        '*combination of uppercase letters, lowercase letters, numbers, and symbols',
    ]
];
