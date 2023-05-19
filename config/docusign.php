<?php

return [

    /**
     * The DocuSign Integrator's Key
     */

    'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),

    /**
     * The Docusign Account Email
     */
    'email' => env('DOCUSIGN_USERNAME'),

    /**
     * The Docusign Account Password
     */
    'password' => env('DOCUSIGN_PASSWORD'),

    /**
     * The version of DocuSign API (Ex: v1, v2)
     */
    'version' => 'v2',

    /**
     * The DocuSign Environment (Ex: demo, test, www)
     */
    'environment' => 'demo',

    /**
     * The DocuSign Account Id
     */
    'account_id' => '14098257',


    /**
     * Envelope Trait Configs 
     */


    /**
     * Envelope ID field 
     */
    'envelope_field' => 'envelopeId',

    /**
    * Recipient IDs to save tabs for upon creating the Envelope (false = Disabled)
    */
    'save_recipient_tabs' => [1],

    /**
    * Envelope Tabs field
    */
    'tabs_field' => 'envelopeTabs',

    /**
    * Envelope Documents field (false = Disabled)
    */
    'documents_field' => 'templateDocuments',
];

