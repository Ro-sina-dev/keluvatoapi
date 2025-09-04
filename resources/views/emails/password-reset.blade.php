@component('mail::message')
# Réinitialisation de votre mot de passe

Bonjour,

Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte **Keluvato Group**.

@component('mail::button', ['url' => $url])
Réinitialiser le mot de passe
@endcomponent

Ce lien expirera dans 60 minutes.  
Si vous n’avez pas demandé de réinitialisation, aucune action n’est requise.

Merci,  
**L’équipe Keluvato Group**
@endcomponent
