<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;

class EmployeeTest extends TestCase
{
    use DatabaseTransactions;

    protected $admin;
    protected $company;
    protected $employee;

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


        $this->employee = Employee::firstOrCreate(
            ['email' => 'mario.rossi@example.com'],
            [
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
                'company_id' => $this->company->id,
                'phone' => '3334445556'
            ]
        );
    }

    #[Test]
    public function an_admin_can_create_an_employee()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/employees', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $this->company->id,
            'email' => 'john.doe@example.com',
            'phone' => '1234567890'
        ]);

        $response->assertRedirect('/employees');
        $this->assertDatabaseHas('employees', ['first_name' => 'John']);
    }

    #[Test]
    public function an_admin_can_read_an_employee()
    {
        $this->actingAs($this->admin);
        $response = $this->get("/employees/{$this->employee->id}");
        $response->assertStatus(200);
        $response->assertSee($this->employee->first_name);
    }

    #[Test]
    public function an_admin_can_update_an_employee()
    {
        $this->actingAs($this->admin);

        $response = $this->put("/employees/{$this->employee->id}", [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'company_id' => $this->company->id,
            'email' => 'jane.smith@example.com',
            'phone' => '0987654321'
        ]);

        $response->assertRedirect(route('employees.show', $this->employee->id));
        $this->assertDatabaseHas('employees', ['first_name' => 'Jane']);
    }

    #[Test]
    public function an_admin_can_delete_an_employee()
    {
        $this->actingAs($this->admin);

        $response = $this->delete("/employees/{$this->employee->id}");

        $response->assertRedirect('/employees');
        $this->assertDatabaseMissing('employees', ['id' => $this->employee->id]);
    }
}
