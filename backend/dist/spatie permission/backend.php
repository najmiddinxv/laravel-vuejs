<?php

use App\Http\Controllers\Backend\{
    ActionLogController,
    AdminController,
    BookCategoryController,
    BookController,
    BranchController,
    BTController,
    CourseCategoryController,
    CourseContentController,
    CourseContentSortController,
    CourseController,
    CourseCurriculumMenuController,
    CourseEnrollmentController,
    CourseInstructorController,
    DocumentCategoryController,
    DocumentController,
    LocalServiceController,
    PersonnnelController,
    PostCategoryController,
    PostController,
    PunishController,
    QuestionController,
    ServiceController,
    StateOrganizationController,
    TagController,
    TestController,
    TestNameController,
    TestTopicController,
    TypeOfPunishmentController,
    VideoCategoryController,
    VideoController,
    HelpController,
    PermissionController,
    RoleController,
    PositoinController,
    UserController
};
use App\Http\Controllers\Backend\Hr\HrController;
use App\Http\Controllers\Backend\Hr\HrUserController;
use App\Http\Controllers\Backend\Manager\ManagerController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin')->name('admin.')->middleware(['isAdmin'])->group(function () {

    //admin control qismi

    Route::middleware(['role:admin|hr|manager,web'])->group(function () {
        Route::prefix('/')->controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/dashboard', 'dashboard')->name('dashboard');
        });
    });

    Route::middleware(['role:admin,web'])->group(function () {

        Route::prefix('action-log')->name('action-log.')->controller(ActionLogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::delete('destroy/{actionLog}', 'destroy')->name('destroy');
        });

        Route::prefix('role')->name('role.')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            // Route::get('show/{id}', 'show)->name('show');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('permission')->name('permission.')->controller(PermissionController::class)->group(function () {
           Route::get('/', 'index')->name('index');
           Route::get('create','create')->name('create');
           Route::post('store','store')->name('store');
           Route::get('edit/{id}','edit')->name('edit');
           Route::put('update/{id}','update')->name('update');
           // Route::get('show/{id}','show')->name('show');
           Route::delete('destroy/{id}','destroy')->name('destroy');
        });

        Route::prefix('book')->name('book.')->controller(BookController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{book}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{book}', 'edit')->name('edit');
            Route::put('update/{book}', 'update')->name('update');
            Route::delete('destroy/{book}', 'destroy')->name('destroy');
        });

        Route::prefix('book-category')->name('book-category.')->controller(BookCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{bookCategory}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{bookCategory}', 'edit')->name('edit');
            Route::put('update/{bookCategory}', 'update')->name('update');
            Route::delete('destroy/{bookCategory}', 'destroy')->name('destroy');
        });

        Route::prefix('course-category')->name('course-category.')->controller(CourseCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseCategory}', 'edit')->name('edit');
            Route::put('update/{courseCategory}', 'update')->name('update');
            Route::delete('destroy/{courseCategory}', 'destroy')->name('destroy');
        });

        Route::prefix('course-instructor')->name('course-instructor.')->controller(CourseInstructorController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseInstructor}', 'edit')->name('edit');
            Route::put('update/{courseInstructor}', 'update')->name('update');
            Route::delete('destroy/{courseInstructor}', 'destroy')->name('destroy');
        });

        Route::prefix('course')->name('course.')->controller(CourseController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('course-create');
            Route::post('store', 'store')->name('store');
            // Route::post('show/{course}', [CourseController::class, 'store'])->name('course.show');
            Route::get('edit/{course}', 'edit')->name('edit');
            Route::put('update/{course}', 'update')->name('update');
            Route::delete('destroy/{course}', 'destroy')->name('destroy');
            Route::delete('coursecontentmenudestroy', 'coursecontentmenudestroy')->name('coursecontentmenudestroy');
        });

        Route::prefix('course-curriculum-menu')->name('course-curriculum-menu.')->controller(CourseCurriculumMenuController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseCurriculumMenu}', 'edit')->name('edit');
            Route::put('update/{courseCurriculumMenu}', 'update')->name('update');
            Route::delete('destroy/{courseCurriculumMenu}', 'destroy')->name('destroy');
        });

        Route::prefix('course-enrollment')->name('course-enrollment.')->controller(CourseEnrollmentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseEnrollment}', 'edit')->name('edit');
            Route::put('update/{courseEnrollment}', 'update')->name('update');
            Route::delete('destroy/{courseEnrollment}', 'destroy')->name('destroy');
        });

        Route::prefix('course-content')->name('course-content.')->controller(CourseContentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseContent}', 'edit')->name('edit');
            Route::put('update/{courseContent}', 'update')->name('update');
            Route::delete('destroy/{courseContent}', 'destroy')->name('destroy');
        });

        Route::prefix('course-content-sort')->name('course-content-sort.')->controller(CourseContentSortController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });

        Route::prefix('document')->name('document.')->controller(DocumentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{document}', 'edit')->name('edit');
            Route::put('update/{document}', 'update')->name('update');
            Route::delete('destroy/{document}', 'destroy')->name('destroy');
        });

        Route::prefix('document-category')->name('document-category.')->controller(DocumentCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{documentCategory}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{documentCategory}', 'edit')->name('edit');
            Route::put('update/{documentCategory}', 'update')->name('update');
            Route::delete('destroy/{documentCategory}', 'destroy')->name('destroy');
        });

        Route::prefix('post')->name('post.')->controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{post}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{post}', 'edit')->name('edit');
            Route::put('update/{post}', 'update')->name('update');
            Route::delete('destroy/{post}', 'destroy')->name('destroy');
            Route::put('update-status/{id}', 'updateStatus')->name('admin.post.update-status');

            Route::get('word-download/{post}', 'word_download')->name('word_download');
            Route::get('html-download/{post}', 'html_download')->name('html_download');
        });

        Route::prefix('post-category')->name('post-category.')->controller(PostCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{postCategory}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{postCategory}', 'edit')->name('edit');
            Route::put('update/{postCategory}', 'update')->name('update');
            Route::delete('destroy/{postCategory}', 'destroy')->name('destroy');
        });

        Route::prefix('test')->name('test.')->controller(TestNameController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('edit/{testName}', 'edit')->name('edit');
            Route::put('update/{testName}', 'update')->name('update');
            Route::delete('destroy/{testName}', 'destroy')->name('destroy');
        });

        Route::prefix('test-questions')->name('test-questions.')->controller(TestController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            //upcoming...
            Route::get('edit/{testQuestion}', 'edit')->name('edit');
            Route::put('update/{testQuestion}', 'update')->name('update');
            Route::delete('destroy/{testQuestion}', 'destroy')->name('destroy');
        });

        Route::prefix('test-topic')->name('test-topic.')->controller(TestTopicController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{topic}', 'destroy')->name('destroy');
        });

        Route::prefix('test-tag')->name('test-tag.')->controller(TagController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });


        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{uuid}', 'show')->name('show');
            Route::get('show-action-logs/{uuid}', 'showActionLogs')->name('showActionLogs');
            Route::get('show-completed-course/{uuid}', 'showCompletedCourse')->name('showCompletedCourse');
            Route::get('show-completed-test/{uuid}', 'showCompletedTest')->name('showCompletedTest');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{uuid}', 'edit')->name('edit');
            Route::put('update/{uuid}', 'update')->name('update');
            Route::delete('destroy/{uuid}', 'destroy')->name('destroy');
        });

        Route::prefix('position')->name('position.')->controller(PositoinController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{position}', 'edit')->name('edit');
            Route::put('update/{position}', 'update')->name('update');
            Route::delete('destroy/{position}', 'destroy')->name('destroy');
        });

        Route::prefix('video')->name('video.')->controller(VideoController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{video}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{video}', 'edit')->name('edit');
            Route::put('update/{video}', 'update')->name('update');
            Route::delete('destroy/{video}', 'destroy')->name('destroy');
        });

        Route::prefix('video-category')->name('video-category.')->controller(VideoCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{videoCategory}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{videoCategory}', 'edit')->name('edit');
            Route::put('update/{videoCategory}', 'update')->name('update');
            Route::delete('destroy/{videoCategory}', 'destroy')->name('destroy');
        });

        Route::prefix('personnnel')->name('personnnel.')->controller(PersonnnelController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{personnnel}', 'update')->name('update');
            Route::delete('destroy/{personnnel}', 'destroy')->name('destroy');
        });
        Route::prefix('branch')->name('branch.')->controller(BranchController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{branch}', 'update')->name('update');
            Route::delete('destroy/{branch}', 'destroy')->name('destroy');
        });
        Route::prefix('locals-ervice')->name('localService.')->controller(LocalServiceController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{localService}', 'update')->name('update');
            Route::delete('destroy/{localService}', 'destroy')->name('destroy');
        });
        Route::prefix('state-organization')->name('stateOrganization.')->controller(StateOrganizationController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{stateOrganization}', 'update')->name('update');
            Route::delete('destroy/{stateOrganization}', 'destroy')->name('destroy');
        });
        Route::prefix('service')->name('service.')->controller(ServiceController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{service}', 'update')->name('update');
            Route::delete('destroy/{service}', 'destroy')->name('destroy');
        });
        Route::prefix('bt')->name('bt.')->controller(BTController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::put('update/{bt}', 'update')->name('update');
            Route::delete('destroy/{bt}', 'destroy')->name('destroy');
        });

        Route::prefix('question')->name('question.')->controller(QuestionController::class)->group(function () {
            Route::get('/','index')->name('index');
            Route::get('show/{question}', 'show')->name('show');
            Route::get('create','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{question}', 'edit')->name('edit');
            Route::put('update/{question}', 'update')->name('update');
            Route::delete('destroy/{question}','destroy')->name('destroy');

        });

        Route::prefix('help')->controller(HelpController::class)->name('help.')->group(function () {
            Route::get('list', 'list')->name('list');
            Route::get('list/show/{help}', 'show')->name('list.show');
            // Route::get('list/edit/{help}', [HelpController::class, 'edit'])->name('help.list.edit');
            // Route::put('list/update/{help}', [HelpController::class, 'update'])->name('help.list.update');
            Route::patch('list/update_status/{help}', 'updateStatus')->name('list.update_status');
            Route::delete('list/delete/{help}', 'destroy')->name('list.destroy');
        });

    });

    //hr qismi
    Route::middleware(['role:admin|hr,web'])->group(function () {

        Route::prefix('hr')->name('hr.')->controller(HrUserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{uuid}', 'show')->name('show');
            Route::get('show-action-logs/{uuid}', 'showActionLogs')->name('showActionLogs');
            Route::get('show-completed-course/{uuid}', 'showCompletedCourse')->name('showCompletedCourse');
            Route::get('show-completed-test/{uuid}', 'showCompletedTest')->name('showCompletedTest');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{uuid}', 'edit')->name('edit');
            Route::put('update/{uuid}', 'update')->name('update');
            Route::delete('destroy/{uuid}', 'destroy')->name('destroy');
        });

        Route::prefix('punish')->controller(PunishController::class)->name('punish.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('users', 'users')->name('users');
            Route::get('punished-users', 'punishedUsers')->name('punishedUsers');
            Route::get('show/{id}', 'show')->name('show');
            Route::get('create-punish', 'createPunish')->name('createPunish');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{punishedUser}', 'update')->name('update');
        });

        Route::prefix('type-of-punishment')->name('type-of-punishment.')->controller(TypeOfPunishmentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{typeOfPunishment}', 'edit')->name('edit');
            Route::put('update/{typeOfPunishment}', 'update')->name('update');
            Route::delete('delete/{typeOfPunishment}', 'delete')->name('delete');
        });

    });

    //manager qismi
    Route::middleware(['role:admin|hr|manager,web'])->group(function () {
        Route::prefix('manager')->controller(ManagerController::class)->name('manager.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

    });

});
