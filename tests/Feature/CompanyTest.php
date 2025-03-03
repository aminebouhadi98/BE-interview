<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;

class CompanyTest extends TestCase
{
    use DatabaseTransactions;

    protected $admin;
    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);


        $this->admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'is_admin' => true
            ]
        );

        $this->company = Company::firstOrCreate(
            ['email' => 'azienda@example.com'],
            [
                'name' => 'Azienda Test',
                'website' => 'https://azienda-test.com'
            ]
        );
    }

    #[Test]
    public function an_admin_can_create_a_company()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/companies', [
            'name' => 'New Company',
            'email' => 'company@example.com',
            'website' => 'https://example.com'
        ]);

        $response->assertRedirect('/companies');
        $this->assertDatabaseHas('companies', ['name' => 'New Company']);
    }

    #[Test]
    public function an_admin_can_read_a_company()
    {
        $this->actingAs($this->admin);
        $response = $this->get("/companies/{$this->company->id}");
        $response->assertStatus(200);
        $response->assertSee($this->company->name);
    }

    #[Test]
    public function an_admin_can_update_a_company()
    {
        $this->actingAs($this->admin);

        $response = $this->put("/companies/{$this->company->id}", [
            'name' => 'Updated Company',
            'email' => 'updated@example.com',
            'website' => 'https://updated-example.com'
        ]);

        $response->assertRedirect(route('companies.show', $this->company->id));
        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);
    }

    #[Test]
    public function an_admin_can_delete_a_company()
    {
        $this->actingAs($this->admin);

        $response = $this->delete("/companies/{$this->company->id}");

        $response->assertRedirect('/companies');
        $this->assertDatabaseMissing('companies', ['id' => $this->company->id]);
    }
}
