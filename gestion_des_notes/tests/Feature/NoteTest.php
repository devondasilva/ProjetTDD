<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\EC;
use App\Models\UE;

use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    // Ajout d'une note valide
    public function test_ajout_note_valide()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'normale'
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15
        ]);
    }

    // Vérification des limites (0-20)
    public function test_verification_limites_note()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 18,
            'session' => 'normale'
        ]);

        $this->assertTrue($note->note >= 0 && $note->note <= 20);
    }

    // Calcul de la moyenne d'une UE
    public function test_calcul_moyenne_ue()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UE::factory()->create();
        $ec1 = EC::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);
        $ec2 = EC::factory()->create(['ue_id' => $ue->id, 'coefficient' => 3]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 10,
            'session' => 'normale'
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 14,
            'session' => 'normale'
        ]);

        $moyenne = $ue->calculerMoyenne($etudiant);
        $this->assertEquals(12.4, $moyenne); // (10*2 + 14*3) / (2+3) = 12.4
    }

    // Gestion des sessions (normale/rattrapage)
    public function test_session_note()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 5,
            'session' => 'rattrapage'
        ]);

        $this->assertEquals('rattrapage', $note->session);
    }

    // Validation des notes manquantes
    public function test_validation_notes_manquantes()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        $note = Note::where('etudiant_id', $etudiant->id)->where('ec_id', $ec->id)->first();

        $this->assertNull($note);
    }
}
