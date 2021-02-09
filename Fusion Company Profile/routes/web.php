<?php

use App\Http\Controllers\AboutUs\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactUs\ContactUsController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\MasterData\ADressCodeController;
use App\Http\Controllers\MasterData\AEventCategoryController;
use App\Http\Controllers\MasterData\AEventPlaceCategoryController;
use App\Http\Controllers\MasterData\AGalleryCategoryController;
use App\Http\Controllers\MasterData\AGuestCategoryController;
use App\Http\Controllers\MasterData\AMealPreferenceController;
use App\Http\Controllers\MasterData\ARoleController;
use App\Http\Controllers\MasterData\ARSVPStatusController;
use App\Http\Controllers\MasterData\ATemplateController;
use App\Http\Controllers\MyEvent\AcknowledgmentController;
use App\Http\Controllers\MyEvent\DressCodeController;
use App\Http\Controllers\MyEvent\EventDetailController;
use App\Http\Controllers\MyEvent\EventPlaceController;
use App\Http\Controllers\MyEvent\FamilyInformationController;
use App\Http\Controllers\MyEvent\GalleryController;
use App\Http\Controllers\MyEvent\GiftWishController;
use App\Http\Controllers\MyEvent\GuestController;
use App\Http\Controllers\MyEvent\MyEventController;
use App\Http\Controllers\MyEvent\OurStoryController;
use App\Http\Controllers\MyEvent\TimelineController;
use App\Http\Controllers\MyEvent\TimelineDetailController;
use App\Http\Controllers\MyEvent\NewEventController;
use App\Http\Controllers\Stream\StreamController;
use App\Http\Controllers\Template\TemplateController;
use App\Http\Controllers\Line\LineController;
use Illuminate\Support\Facades\Route;

/* Home */
Route::get('/', [HomeController::class, 'Index']);
Route::get('/service', [ServiceController::class, 'Index']);

/* Template */
Route::group(['prefix' => 'template'], function () {
    Route::get('/', [TemplateController::class, 'Index']);
    Route::get('{template_code}', [TemplateController::class, 'IndexTemplateCode']);
});

/* New Event */
Route::group(['prefix' => 'new-event'], function () {
    Route::get('/', [NewEventController::class, 'Index']);
});

Route::group(['prefix' => 'watch'], function () {
    Route::get('/', [StreamController::class, 'IndexWatch']);
});

/* My Event */
Route::group(['prefix' => 'my-event'], function () {
    Route::get('/', [MyEventController::class, 'Index']);
    Route::post('/', [MyEventController::class, 'Store']);
    Route::post('/{id}/edit', [MyEventController::class, 'UpdateEvent']);
    Route::post('/{id}/delete', [MyEventController::class, 'DeleteEvent']);
    Route::get('dt', [MyEventController::class, 'DataTable']);

    // Event Detail
    Route::get('/{event_code}', [MyEventController::class, 'ShowEvent']);
    Route::get('/{event_code}/preview', [MyEventController::class, 'ShowEvent']);

    // RSVP
    Route::get('/{event_code}/rsvp/{guest_id}', [MyEventController::class, 'RSVP']);
    Route::post('/{event_code}/rsvp/{guest_id}', [MyEventController::class, 'StoreRSVP']);
    Route::get('/{event_code}/rsvp-result/{guest_id}', [MyEventController::class, 'RSVPResult']);

    // Print QR Code
    Route::get('/{event_code}/qr-code', [MyEventController::class, 'QRCode']);
    Route::get('/{event_code}/test', [MyEventController::class, 'ShowEvent'])->name('my-event-test');

    // Belum Bisa Print PDF
    // Route::post('/{event_code}/qr-code', 'MyEvent\MyEventController@PrintQRCode');

    // Guest
    Route::group(['prefix' => 'guest'], function () {
        Route::get('/{event_id}/add', [GuestController::class, 'Index']);
        Route::post('/{event_id}/add', [GuestController::class, 'Store']);
        Route::post('/{event_id}/edit/{guest_id}', [GuestController::class, 'UpdateGuest']);
        Route::post('/{event_id}/delete/{guest_id}', [GuestController::class, 'DeleteGuest']);
        Route::get('/{event_id}/dt', [GuestController::class, 'DataTable']);

        // Belum Bisa Print PDF
        Route::get('/{event_id}/print', [GuestController::class, 'Print']);
    });

    // Event Detail
    Route::group(['prefix' => 'detail'], function () {
        Route::get('/{event_id}', [EventDetailController::class, 'Index']);

        Route::post('/{event_id}/family-information/add', [FamilyInformationController::class, 'Store']);
        Route::post('/{event_id}/family-information/edit', [FamilyInformationController::class, 'UpdateFamilyInformation']);

        Route::post('/{event_id}/acknowledgment/add', [AcknowledgmentController::class, 'Store']);
        Route::post('/{event_id}/acknowledgment/edit', [AcknowledgmentController::class, 'UpdateAcknowledgment']);

        Route::post('/{event_id}/event-place/add', [EventPlaceController::class, 'Store']);
        Route::post('/{event_id}/event-place/{event_place_id}/edit', [EventPlaceController::class, 'UpdateEventPlace']);
        Route::post('/{event_id}/event-place/{event_place_id}/delete', [EventPlaceController::class, 'DeleteEventPlace']);

        Route::post('/{event_id}/gift-wish/add', [GiftWishController::class, 'Store']);
        Route::post('/{event_id}/gift-wish/{gift_wish_id}/edit', [GiftWishController::class, 'UpdateGiftWish']);
        Route::post('/{event_id}/gift-wish/{gift_wish_id}/delete', [GiftWishController::class, 'DeleteGiftWish']);

        Route::post('/{event_id}/our-story/add', [OurStoryController::class, 'Store']);
        Route::post('/{event_id}/our-story/edit', [OurStoryController::class, 'UpdateOurStory']);

        Route::post('/{event_id}/registry/add', [OurStoryController::class, 'StoreRegistry']);
        Route::post('/{event_id}/registry/edit', [OurStoryController::class, 'UpdateRegistry']);

        Route::post('/{event_id}/gallery_header/add', [GalleryController::class, 'StoreGalleryHeader']);
        Route::post('/{event_id}/gallery_header/edit', [GalleryController::class, 'UpdateGalleryHeader']);

        Route::post('/{event_id}/timeline/add', [TimelineController::class, 'Store']);
        Route::post('/{event_id}/timeline/edit', [TimelineController::class, 'UpdateTimeline']);

        Route::post('/{event_id}/timeline-detail/add', [TimelineDetailController::class, 'Store']);
        Route::post('/{event_id}/timeline-detail/{timeline_detail_id}/edit', [TimelineDetailController::class, 'UpdateTimelineDetail']);
        Route::post('/{event_id}/timeline-detail/{timeline_detail_id}/delete', [TimelineDetailController::class, 'DeleteTimelineDetail']);

        Route::post('/{event_id}/gallery/add', [GalleryController::class, 'Store']);
        Route::post('/{event_id}/gallery/{gallery_id}/delete', [GalleryController::class, 'DeleteGallery']);

        Route::post('/{event_id}/dress-code/edit', [DressCodeController::class, 'UpdateDressCode']);
    });
});

/* About Us */
Route::get('about-us', [AboutUsController::class, 'Index']);

/* Contact Us */
Route::get('contact-us', [ContactUsController::class, 'Index']);

/* Verification */
Route::get('/verification/{verification_code}', [LoginController::class, 'StoreVerification']);

/* Reset Password */
Route::get('/reset-password', [LoginController::class, 'IndexResetPassword']);
Route::post('/reset-password', [LoginController::class, 'RequestResetPassword']);

Route::get('/reset-password/{id}', [LoginController::class, 'IndexNewPassword']);
Route::post('/reset-password/{id}', [LoginController::class, 'RequestNewPassword']);

/* Register, Login, and Logout */
Route::get('/login', [LoginController::class, 'IndexLogin']);
Route::post('/login', [LoginController::class, 'StoreLogin']);

Route::get('/register', [LoginController::class, 'IndexRegister']);
Route::post('/register', [LoginController::class, 'StoreRegister']);

Route::get('/register-eo', [LoginController::class, 'IndexRegisterEO']);
Route::post('/register-eo', [LoginController::class, 'StoreRegisterEO']);

Route::get('/logout', [LoginController::class, 'StoreLogout']);

/* Profile and Account*/
Route::get('/profile', [LoginController::class, 'IndexProfile']);
Route::post('/profile', [LoginController::class, 'UpdateProfile']);

Route::get('/account', [LoginController::class, 'IndexAccount']);
Route::post('/account', [LoginController::class, 'UpdateAccount']);

/* Master Data */
Route::group(['prefix' => 'master-data'], function () {
    // Dress Code
    Route::group(['prefix' => 'dress-code'], function () {
        Route::get('/', [ADressCodeController::class, 'Index']);
        Route::post('/', [ADressCodeController::class, 'Store']);
        Route::post('/{id}/edit', [ADressCodeController::class, 'UpdateDC']);
        Route::post('/{id}/delete', [ADressCodeController::class, 'DeleteDC']);
        Route::get('dt', [ADressCodeController::class, 'DataTable']);
    });

    // Event Category
    Route::group(['prefix' => 'event-category'], function () {
        Route::get('/', [AEventCategoryController::class, 'Index']);
        Route::post('/', [AEventCategoryController::class, 'Store']);
        Route::post('/{id}/edit', [AEventCategoryController::class, 'UpdateEC']);
        Route::post('/{id}/delete', [AEventCategoryController::class, 'DeleteEC']);
        Route::get('dt', [AEventCategoryController::class, 'DataTable']);
    });

    // Event Place Category
    Route::group(['prefix' => 'event-place-category'], function () {
        Route::get('/', [AEventPlaceCategoryController::class, 'Index']);
        Route::post('/', [AEventPlaceCategoryController::class, 'Store']);
        Route::post('/{id}/edit', [AEventPlaceCategoryController::class, 'UpdateEPC']);
        Route::post('/{id}/delete', [AEventPlaceCategoryController::class, 'DeleteEPC']);
        Route::get('dt', [AEventPlaceCategoryController::class, 'DataTable']);
    });

    // Gallery Category
    Route::group(['prefix' => 'gallery-category'], function () {
        Route::get('/', [AGalleryCategoryController::class, 'Index']);
        Route::post('/', [AGalleryCategoryController::class, 'Store']);
        Route::post('/{id}/edit', [AGalleryCategoryController::class, 'UpdateGC']);
        Route::post('/{id}/delete', [AGalleryCategoryController::class, 'DeleteGC']);
        Route::get('dt', [AGalleryCategoryController::class, 'DataTable']);
    });

    // Guest Category
    Route::group(['prefix' => 'guest-category'], function () {
        Route::get('/', [AGuestCategoryController::class, 'Index']);
        Route::post('/', [AGuestCategoryController::class, 'Store']);
        Route::post('/{id}/edit', [AGuestCategoryController::class, 'UpdateGC']);
        Route::post('/{id}/delete', [AGuestCategoryController::class, 'DeleteGC']);
        Route::get('dt', [AGuestCategoryController::class, 'DataTable']);
    });

    // Meal Preference
    Route::group(['prefix' => 'meal-preference'], function () {
        Route::get('/', [AMealPreferenceController::class, 'Index']);
        Route::post('/', [AMealPreferenceController::class, 'Store']);
        Route::post('/{id}/edit', [AMealPreferenceController::class, 'UpdateMP']);
        Route::post('/{id}/delete', [AMealPreferenceController::class, 'DeleteMP']);
        Route::get('dt', [AMealPreferenceController::class, 'DataTable']);
    });

    // Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [ARoleController::class, 'Index']);
        Route::post('/', [ARoleController::class, 'Store']);
        Route::post('/{id}/edit', [ARoleController::class, 'UpdateR']);
        Route::post('/{id}/delete', [ARoleController::class, 'DeleteR']);
        Route::get('dt', [ARoleController::class, 'DataTable']);
    });

    // RSVP Status
    Route::group(['prefix' => 'rsvp-status'], function () {
        Route::get('/', [ARSVPStatusController::class, 'Index']);
        Route::post('/', [ARSVPStatusController::class, 'Store']);
        Route::post('/{id}/edit', [ARSVPStatusController::class, 'UpdateRSVP']);
        Route::post('/{id}/delete', [ARSVPStatusController::class, 'DeleteRSVP']);
        Route::get('dt', [ARSVPStatusController::class, 'DataTable']);
    });

    // Template
    Route::group(['prefix' => 'template'], function () {
        Route::get('/', [ATemplateController::class, 'Index']);
        Route::post('/', [ATemplateController::class, 'Store']);
        Route::post('/{id}/edit', [ATemplateController::class, 'UpdateTemplate']);
        Route::post('/{id}/delete', [ATemplateController::class, 'DeleteTemplate']);
        Route::get('dt', [ATemplateController::class, 'DataTable']);
    });
});

/* LINE */
Route::group(['prefix' => 'line'], function () {
    Route::group(['prefix' => 'game'], function () {
        Route::get('/click-game', [LineController::class, 'IndexClickGame']);
        Route::post('/click-game', [LineController::class, 'SaveClickGame']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', [LineController::class, 'IndexUserProfile']);
    });
});
