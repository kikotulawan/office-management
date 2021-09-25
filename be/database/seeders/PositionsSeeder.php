<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Chief Executive Officer',
                'description' => 'Highest-ranking executive in a company, whose primary responsibilities include making major corporate decisions, managing the overall operations and resources of a company, acting as the main point of communication between the board of directors (the board) and corporate operations and being the public face of the company.',
            ],
            [
                'name' => 'President',
                'description' => 'Responsible for establishing a company goals and strategies and presiding over the entire workforce. Oversees budgets and ensures resources are properly allocated. Ensures departments meet individual goals. Responsible for overall accountability to shareholders and the general public.',
            ],
            [
                'name' => 'Vice President',
                'description' => 'Assisting the president and the board of directors to design the company overall mission, values, and strategic goals.',
            ],
            [
                'name' => 'Cheif Human Resource Officer',
                'description' => 'Responsible for leading managers of the division and indirectly responsible for all employees within the division.
                ',
            ],
            [
                'name' => 'Human Resource Officer',
                'description' => 'Responsible for providing support in the various human resources and functions, which include recruitment, staffing, training and development, performance monitoring and employee counseling.',
            ],
        ];
        
        foreach($data as $position){
            Position::create($position);
        }
    }
}
