<?php

declare(strict_types=1);

$cases = [
    'multiply sockets and cores as a string' => [2, 12, '24'],
    'accept a single core' => [1, 1, '1'],
    'normalize numeric strings' => ['2', '8', '16'],
    'clear a stale count when sockets are missing' => [null, 8, null],
    'clear a stale count when cores are missing' => [2, null, null],
    'handle both inputs missing' => [null, null, null],
    'reject zero sockets' => [0, 8, null],
    'reject zero cores' => [2, 0, null],
    'reject negative sockets' => [-1, 8, null],
    'reject negative cores' => [2, -8, null],
];

$tests = [];
foreach ($cases as $name => [$sockets, $cores, $expected]) {
    $tests[$name] = static function () use ($sockets, $cores, $expected): void {
        $server = new class {
            use CpuCalculationUnderTest;

            public array $values = [];

            public function Get(string $attribute): mixed
            {
                return $this->values[$attribute];
            }

            public function Set(string $attribute, mixed $value): void
            {
                $this->values[$attribute] = $value;
            }
        };
        $server->values = [
            'cpu_sockets' => $sockets,
            'cpu_cores' => $cores,
            'cpu_count' => 'stale',
        ];
        $server->SetCpuCount();
        $actual = $server->Get('cpu_count');
        if ($actual !== $expected) {
            throw new RuntimeException(
                'Expected ' . var_export($expected, true) . ', got ' . var_export($actual, true)
            );
        }
    };
}

return $tests;
