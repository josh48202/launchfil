<?php

namespace App\Providers\Filament;

use App\Auth\Socialite\AzureTenantAuthorizer;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Illuminate\Validation\Rules\Password;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentUsersPlugin::make(),
                BreezyCore::make()
                    ->myProfile(shouldRegisterNavigation: true, slug: 'profile', navigationGroup: 'Account', userMenuLabel: 'Profile')
                    ->enableTwoFactorAuthentication(force: fn() => empty(auth()->user()->socialiteUser))
                    ->enableBrowserSessions()
                    ->enableSanctumTokens(false)
                    ->passwordUpdateRules(
                        rules: ['min:8', Password::default()->mixedCase()->uncompromised(3)],
                        requiresCurrentPassword: false
                    ),
                FilamentSocialitePlugin::make()
                    ->providers([
                        Provider::make('azure')
                            ->label('Continue with Microsoft')
                            ->icon('fab-microsoft')
                            ->color(Color::hex('#FFFFFF'))
                    ])
                    ->registration()
                    ->authorizeUserUsing(function (FilamentSocialitePlugin $plugin, SocialiteUserContract $oauthUser) {
                        return AzureTenantAuthorizer::checkTenantAllowList($plugin, $oauthUser);
                    }),
            ]);
    }
}
