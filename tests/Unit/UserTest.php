<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\student;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use RefreshDatabase;
use App\Models\attempt;
use App\Models\tenth;

class UserTest extends TestCase
{


    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_login_route()
    {
      $response = $this->get('/');
      $response->assertStatus(200);

     }
    public function test_login_admin()
    {
        User::factory()->create(['role'=>'admin']);
        $response = $this->post('/login',[
            'email'=>'admin@admin.com',
            'password'=> 'password'
        ]);
        $response->assertRedirect('/admin/dashboard');
    }

    public function test_login_teacher()
    {
        User::factory()->create(['role'=>'teacher']);
        $response = $this->post('/login',[
            'email'=>'admin@admin.com',
            'password'=> 'password'
        ]);
        $response->assertRedirect('/teacher/dashboard');
    }

    public function test_Admin_Can_Add_Student()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin);
        $this->post('/admin/addstudent',[
            'name'=>'Abc',
            'father_name'=>'Xyz',
            'class'=> '10th',
            'rollno'=>'01',
            'email'=>'test@test.com',
        ]);
         $this->assertDatabaseHas('students',['email'=>'khijru@test.com']);

    }

    public function test_Admin_can_Add_teacher()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin);
        $response = $this->post('/admin/adduser',[
            'name'=> 'Teacher',
            'email'=>'teacher@test.com'
        ]);
        $this->assertDatabaseHas('users',['email'=>'teacher@test.com']);
    }

    public function test_Admin_can_change_password()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin);
        $response = $this->post('/admin/c_password',[
            'password'=> 'password',
            'password_c'=>'password',
        ]);
        $response->assertRedirect('admin/dashboard');
    }



    public function test_admin_can_delete_student()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin);
        $studentId = Student::factory()->create()->id;
        $response = $this->get('admin/deletestudent/'.$studentId);
        $response->assertRedirect('admin/viewstudents');
    }

    public function test_Admin_can_update_student_Details()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin);
        $studentId = Student::factory()->create()->id;
        $response = $this->post('admin/editstudent/updatestudent',[
            'id'=> $studentId,
            'name'=> 'student',
            'father_name'=>'father_name',
            'email'=>'email@test.com',
            'rollno'=> '01',
            'class'=>'10th'
        ]);
       $this->assertDatabaseHas('students',['email'=>'email@test.com']);
    }

    public function test_teacher_can_change_password()
    {
        $teacher = User::factory()->create(['role'=>'teacher']);
        $this->actingAs($teacher);
        $response = $this->post('/teacher/c_password',[
            'password'=> 'password',
            'password_c'=>'password',
        ]);
        $response->assertRedirect('teacher/dashboard');
    }
public function test_teacher_can_update_student_details()
{
    $teacher = User::factory()->create(['role'=>'teacher']);
        $this->actingAs($teacher);
        $studentId = Student::factory()->create()->id;
        $response = $this->post('teacher/editstudent/updatestudent',[
            'id'=> $studentId,
            'name'=> 'student',
            'father_name'=>'father_name',
            'email'=>'email@test.com',
            'rollno'=> '01',
            'class'=>'10th'
        ]);
       $this->assertDatabaseHas('students',['email'=>'email@test.com']);
}

public function test_teacher_can_add_student()
{
    $teacher = User::factory()->create(['role'=>'teacher']);
    $this->actingAs($teacher);
    $response = $this->post('/addstudent',[
        'name'=>'saddam',
        'father_name'=> 'M H Malik',
        'class'=>'12th',
        'rollno'=>'100',
        'email'=>'gmail@gmail.com'
    ]);
    $this->assertDatabaseHas('students',['email'=>'gmail@gmail.com']);
}

public function test_teacher_can_create_test()
{
    $teacher = User::factory()->create(['role'=>'teacher']);
    $this->actingAs($teacher);
    $this->post('/teacher/addquestion',[
        'no'=>'1',
        'class'=>'10th',
        'qns0'=>'what',
        'a0'=>'is',
        'b0'=>'saved',
        'c0'=>'in',
        'd0'=>'databse',
        'ans0'=>'a'
    ]);
    $this->assertDatabaseHas('10th',['Question'=>'what']);
}
public function test_student_can_login()
{
    student::factory()->create();
    $response = $this->post('/stulogin',[
        'email'=>'saddam@test.com',
        'password'=>'password',
    ]);
    $response->assertRedirect('studentdashboard');
}

public function test_student_can_change_password()
{
    $student = student::factory()->create();
    $response = $this->post('changepassword/c_password',[
        'id'=> $student['id'],
        'password'=>'password1',
        'password_c'=>'password1',
    ]);
    $response->assertRedirect('studentdashboard');
}

}
