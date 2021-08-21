<?php

function evaluate($expression){
    $result = 0;
    switch($expression['type']){
        case 'add':
            foreach($expression['children'] as $child){
                $result += evaluate($child);
            }
            break;
        case 'multiply':
            $tmp = 1;
            foreach($expression['children'] as $child){
                $tmp *= evaluate($child);
            }
            $result = $tmp;
            break;
        case 'fraction':
            $result = evaluate($expression['top']) / evaluate($expression['bottom']);
            break;
        case 'number':
            $result = $expression['value'];
            break;
    }
    return $result;
}

// 100 + 200 + 300
$expression1 = [
    "type" => "add",
    'children'=> [
        [
            "type" => "number",
            "value"=>100
        ],
        [
            "type" => "number",
            "value"=> 200
        ],
        [
            "type" => "number",
            "value"=> 300
        ]
    ]
];

// 100 + 2 * (50 +5)
$expression2 = [
    "type" => "add",
    'children'=> [
        [
            "type" => "number",
            "value"=>100
        ],
        [
            "type" => "multiply",
            "children" =>[
                [
                    "type" => "number",
                    "value"=>2
                ],
                [
                    "type" => "add",
                    "children" =>[
                        [
                            "type" => "number",
                            "value"=>5
                        ],
                        [
                            "type" => "number",
                            "value"=>45
                        ]
                    ]
                ]
            ]
        ]
    ]
];



// 1 + 100 / 1000
$expression3 = [
    "type" => "add",
    'children'=> [
        [
            "type" => "number",
            "value"=>1
        ],
        [
            "type" => "fraction",
            "top"=>
                [
                    "type" => "number",
                    "value"=>100
                ],
            "bottom"=>
                [
                    "type" => "number",
                    "value"=>1000
                ]
        ]
    ]
];

echo "Expression 1 evaluates to: " . evaluate($expression1) . " <br>";

echo "Expression 2 evaluates to: " . evaluate($expression2) . " <br>";

echo "Expression 3 evaluates to: " . evaluate($expression3) . " <br>";
