@component('mail::message')
# Réinitialisation de mot de passe

Bonjour,

Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Réinitialiser mon mot de passe
@endcomponent

Ce lien expirera dans **60 minutes**.

Si vous n'avez pas demandé de réinitialisation, ignorez cet email.

Cordialement,
**Collège Saint Jean des Cayes**
@endcomponent