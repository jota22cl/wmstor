<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use App\Filament\Pages\Auth\Login;
use Filament\Support\Colors\Color;
use Filament\Pages\Auth\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
//use App\Filament\Pages\Login;


class AdminPanelProvider extends PanelProvider
{
    //protected static ?string $title = 'Finance dashboard';
    public function panel(Panel $panel): Panel
    {
        //dd($panel);
        //dd(auth());
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->favicon(asset('images/WMStor-favicon.png')) //favicon de la URL
            //->brandName('WMStor') // nombre que aparece en la esquina superior izquierda
            ->brandName('') // Con esto no aparece el nombre del sistema
            //->brandLogo(asset('images/Storage.png'))
            //->brand('<img src="' . asset('images/Storage.png') . '" alt="Logo" style="height: 40px;">')
            ->login(Login::class)
            //->revealablePasswords(true)
            //->registration()
            ->passwordReset()    //para colocar un "olvide mi clave" en el login
            //->profile(EditProfile::class)
            ->userMenuItems([
                //'profile' => MenuItem::make()->label('Perfil de usuario'),
                'logout' => MenuItem::make()->label('Sale de sistema'),
            ])
            ->colors([
                //'primary' => Color::Amber,
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            //->brandLogo(asset('images/WMStor-favicon.png'))
            //->brandLogo(fn () => view('filament.admin.logo'))
            //->unsavedChangesAlerts()
            /****************************** */
            ->topNavigation(true)              // menu lateral FALSE ---- menu top TRUE
            ->sidebarCollapsibleOnDesktop(false) // menu lateral TRUE  ---- menu top FALSE
            /****************************** */
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                'Gestión Bodega',
                'Tablas Maestras',
                'Tablas Generales',
                'Administración del Sistema',
            ]);
    }
}
