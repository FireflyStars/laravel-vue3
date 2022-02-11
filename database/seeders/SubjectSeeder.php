<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'name' => 'A01:2021-Broken Access Control',
            ],
            [
                'name' => 'A02:2021-Cryptographic Failures',
            ],
            [
                'name' => 'A03:2021-Injection',
            ],
            [
                'name' => 'A04:2021-Insecure Design',
            ],
            [
                'name' => 'A05:2021-Security Misconfiguration',
            ],
            [
                'name' => 'A06:2021-Vulnerable and Outdated Components',
            ],
            [
                'name' => 'A07:2021-Identification and Authentication Failures',
            ],
            [
                'name' => 'A08:2021-Software and Data Integrity Failures',
            ],
            [
                'name' => 'A09:2021-Security Logging and Monitoring Failures',
            ],
            [
                'name' => 'A10:2021-Server-Side Request Forgery',
            ]
        ];
        foreach ($subjects as  $item) {
            Subject::create($item);
        }
    }
}
