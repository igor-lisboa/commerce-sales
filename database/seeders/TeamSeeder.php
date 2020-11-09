<?php

namespace Database\Seeders;

use App\Actions\Jetstream\AddTeamMember;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Laravel\Jetstream\Jetstream;

class TeamSeeder extends Seeder
{

    private $addTeamMember;

    public function __construct(AddTeamMember $addTeamMember)
    {
        $this->addTeamMember = $addTeamMember;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $user_2 = User::find(2);

        $team = Team::create([
            "user_id" => $user->id,
            "name" => "Mundial",
            "personal_team" => true
        ]);

        $team->users()->attach(
            $newTeamMember = Jetstream::findUserByEmailOrFail($user->email)
        );
        TeamMemberAdded::dispatch($team, $newTeamMember);

        $team->users()->attach(
            $newTeamMember = Jetstream::findUserByEmailOrFail($user_2->email)
        );
        TeamMemberAdded::dispatch($team, $newTeamMember);
    }
}
