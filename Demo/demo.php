<?php

use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Index;
use MChristie\Semaphore\Library;
use MChristie\Semaphore\Semaphore;
use MChristie\Semaphore\Symbols\UUID;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Hexadecimal;
use MChristie\Semaphore\Symbols\Alphanumeric;

require 'helpers.php';
require __DIR__ . '/../src/Symbol.php';
require __DIR__ . '/../src/Bits.php';
require __DIR__ . '/../src/BitStream.php';
require __DIR__ . '/../src/CharacterConverter.php';
require __DIR__ . '/../src/CharacterSets.php';
require __DIR__ . '/../src/Index.php';
require __DIR__ . '/../src/Library.php';
require __DIR__ . '/../src/Semaphore.php';
require __DIR__ . '/../src/Symbols/CharacterEncodingSymbol.php';
require __DIR__ . '/../src/Symbols/Alphanumeric.php';
require __DIR__ . '/../src/Symbols/Boolean.php';
require __DIR__ . '/../src/Symbols/Hexadecimal.php';
require __DIR__ . '/../src/Symbols/Integer.php';
require __DIR__ . '/../src/Symbols/UUID.php';







































































$values = [
    'ABILITY_RESPONSES_VIEW'                        => true,
    'ABILITY_RESPONSES_CREATE'                      => true,
    'ABILITY_RESPONSES_UPDATE'                      => false,
    'ABILITY_RESPONSES_DELETE'                      => true,
    'ABILITY_RESPONSES_EXPORT'                      => true,
    'ABILITY_CONTACTS_UNSUBSCRIBE'                  => true,
    'ABILITY_CONTACTS_VIEW'                         => true,
    'ABILITY_CONTACTS_CREATE'                       => true,
    'ABILITY_CONTACTS_UPDATE'                       => false,
    'ABILITY_CONTACTS_DELETE'                       => true,
    'ABILITY_DASHBOARDS_VIEW'                       => true,
    'ABILITY_DASHBOARDS_CREATE'                     => true,
    'ABILITY_DASHBOARDS_UPDATE'                     => false,
    'ABILITY_DASHBOARDS_DELETE'                     => true,
    'ABILITY_CONTACT_DASHBOARD'                     => true,
    'ABILITY_DEVICES_VIEW'                          => true,
    'ABILITY_DEVICES_CREATE'                        => true,
    'ABILITY_DEVICES_UPDATE'                        => false,
    'ABILITY_DEVICES_DELETE'                        => true,
    'ABILITY_EXPORTS'                               => true,
    'ABILITY_EXPORT_RECIPIENTS'                     => true,
    'ABILITY_FORMS_VIEW'                            => true,
    'ABILITY_FORMS_CREATE'                          => true,
    'ABILITY_FORMS_UPDATE'                          => false,
    'ABILITY_FORMS_DELETE'                          => true,
    'ABILITY_IMPORTS'                               => true,
    'ABILITY_USERS_VIEW'                            => true,
    'ABILITY_USERS_CREATE'                          => true,
    'ABILITY_USERS_UPDATE'                          => false,
    'ABILITY_USERS_DELETE'                          => true,
    'ABILITY_USERS_INVITE'                          => true,
    'ABILITY_ENROLMENTS_VIEW'                       => true,
    'ABILITY_ENROLMENTS_CREATE'                     => true,
    'ABILITY_ENROLMENTS_UPDATE'                     => false,
    'ABILITY_ENROLMENTS_DELETE'                     => true,
    'ABILITY_EVENTS_VIEW'                           => true,
    'ABILITY_EVENTS_CREATE'                         => true,
    'ABILITY_EVENTS_UPDATE'                         => false,
    'ABILITY_EVENTS_DELETE'                         => true,
    'ABILITY_FIELDS_VIEW'                           => true,
    'ABILITY_FIELDS_CREATE'                         => true,
    'ABILITY_FIELDS_UPDATE'                         => false,
    'ABILITY_FIELDS_DELETE'                         => true,
    'ABILITY_FILES_VIEW'                            => true,
    'ABILITY_FILES_CREATE'                          => true,
    'ABILITY_FILES_UPDATE'                          => false,
    'ABILITY_FILES_DELETE'                          => true,
    'ABILITY_GROUPS_VIEW'                           => true,
    'ABILITY_GROUPS_CREATE'                         => true,
    'ABILITY_GROUPS_UPDATE'                         => false,
    'ABILITY_GROUPS_DELETE'                         => true,
    'ABILITY_INTEGRATIONS_VIEW'                     => true,
    'ABILITY_INTEGRATIONS_CREATE'                   => true,
    'ABILITY_INTEGRATIONS_UPDATE'                   => false,
    'ABILITY_INTEGRATIONS_DELETE'                   => true,
    'ABILITY_INTERACTIONS_VIEW'                     => true,
    'ABILITY_INTERACTIONS_CREATE'                   => true,
    'ABILITY_INTERACTIONS_UPDATE'                   => false,
    'ABILITY_INTERACTIONS_DELETE'                   => true,
    'ABILITY_MEDIA_VIEW'                            => true,
    'ABILITY_MEDIA_CREATE'                          => true,
    'ABILITY_MEDIA_UPDATE'                          => false,
    'ABILITY_MEDIA_DELETE'                          => true,
    'ABILITY_MESSAGES_VIEW'                         => true,
    'ABILITY_MESSAGES_CREATE'                       => true,
    'ABILITY_MESSAGES_UPDATE'                       => false,
    'ABILITY_MESSAGES_DELETE'                       => true,
    'ABILITY_NOTES_VIEW'                            => true,
    'ABILITY_NOTES_CREATE'                          => true,
    'ABILITY_NOTES_UPDATE'                          => false,
    'ABILITY_NOTES_DELETE'                          => true,
    'ABILITY_NUMBERS_VIEW'                          => true,
    'ABILITY_NUMBERS_CREATE'                        => true,
    'ABILITY_NUMBERS_UPDATE'                        => false,
    'ABILITY_NUMBERS_DELETE'                        => true,
    'ABILITY_OPTIONS_CREATE'                        => true,
    'ABILITY_OPTIONS_UPDATE'                        => false,
    'ABILITY_OPTIONS_DELETE'                        => true,
    'ABILITY_OUTCOMES_VIEW'                         => true,
    'ABILITY_OUTCOMES_CREATE'                       => true,
    'ABILITY_OUTCOMES_UPDATE'                       => false,
    'ABILITY_OUTCOMES_DELETE'                       => true,
    'ABILITY_OUTCOMES_CUSTOM'                       => true,
    'ABILITY_SCHEDULES_VIEW'                        => true,
    'ABILITY_SCHEDULES_CREATE'                      => true,
    'ABILITY_SCHEDULES_UPDATE'                      => false,
    'ABILITY_SCHEDULES_DELETE'                      => true,
    'ABILITY_SENDERS_VIEW'                          => true,
    'ABILITY_SENDERS_CREATE'                        => true,
    'ABILITY_SENDERS_UPDATE'                        => false,
    'ABILITY_SENDERS_DELETE'                        => true,
    'ABILITY_SENDERS_VOIP'                          => true,
    'ABILITY_SUBSCRIBERS_VIEW'                      => true,
    'ABILITY_SUBSCRIBERS_CREATE'                    => true,
    'ABILITY_SUBSCRIBERS_UPDATE'                    => false,
    'ABILITY_SUBSCRIBERS_DELETE'                    => true,
    'ABILITY_TEMPLATES_VIEW'                        => true,
    'ABILITY_TEMPLATES_CREATE'                      => true,
    'ABILITY_TEMPLATES_UPDATE'                      => false,
    'ABILITY_TEMPLATES_DELETE'                      => true,
    'ABILITY_TRANSACTIONS_VIEW'                     => true,
    'ABILITY_TRANSACTIONS_CREATE'                   => true,
    'ABILITY_TRANSACTIONS_UPDATE'                   => false,
    'ABILITY_TRANSACTIONS_DELETE'                   => true,
    'ABILITY_TWILIO'                                => true,
    'ABILITY_VALUES_VIEW'                           => true,
    'ABILITY_VALUES_CREATE'                         => true,
    'ABILITY_VALUES_UPDATE'                         => false,
    'ABILITY_VALUES_DELETE'                         => true,
    'ABILITY_WIDGETS_VIEW'                          => true,
    'ABILITY_WIDGETS_CREATE'                        => true,
    'ABILITY_WIDGETS_UPDATE'                        => false,
    'ABILITY_WIDGETS_DELETE'                        => true,
    'ABILITY_WORKFLOWS_VIEW'                        => true,
    'ABILITY_WORKFLOWS_CREATE'                      => true,
    'ABILITY_WORKFLOWS_UPDATE'                      => false,
    'ABILITY_WORKFLOWS_DELETE'                      => true,
    'ABILITY_ORGANISATIONS_VIEW'                    => true,
    'ABILITY_ORGANISATIONS_CREATE'                  => true,
    'ABILITY_ORGANISATIONS_UPDATE'                  => false,
    'ABILITY_ORGANISATIONS_DELETE'                  => true,
    'ABILITY_LANDING_PAGES_VIEW'                    => true,
    'ABILITY_LANDING_PAGES_CREATE'                  => true,
    'ABILITY_LANDING_PAGES_UPDATE'                  => false,
    'ABILITY_LANDING_PAGES_DELETE'                  => true,
    'ABILITY_CALLS_VIEW'                            => true,
    'ABILITY_CALLS_CREATE'                          => true,
    'ABILITY_CALLS_UPDATE'                          => false,
    'ABILITY_CALLS_DELETE'                          => true,
    'ABILITY_CALLS_LISTEN'                          => true,
    'ABILITY_CALL_CAMPAIGNS_VIEW'                   => true,
    'ABILITY_CALL_CAMPAIGNS_CREATE'                 => true,
    'ABILITY_CALL_CAMPAIGNS_UPDATE'                 => false,
    'ABILITY_CALL_CAMPAIGNS_DELETE'                 => true,
    'ABILITY_BROADCASTS_VIEW'                       => true,
    'ABILITY_BROADCASTS_CREATE'                     => true,
    'ABILITY_BROADCASTS_UPDATE'                     => false,
    'ABILITY_BROADCASTS_DELETE'                     => true,
    'ABILITY_SMS_BROADCASTS_VIEW'                   => true,
    'ABILITY_SMS_BROADCASTS_CREATE'                 => true,
    'ABILITY_SMS_BROADCASTS_UPDATE'                 => false,
    'ABILITY_SMS_BROADCASTS_DELETE'                 => true,
    'ABILITY_EMAIL_BROADCASTS_VIEW'                 => true,
    'ABILITY_EMAIL_BROADCASTS_CREATE'               => true,
    'ABILITY_EMAIL_BROADCASTS_UPDATE'               => false,
    'ABILITY_EMAIL_BROADCASTS_DELETE'               => true,
    'ABILITY_SCRIPTS_VIEW'                          => true,
    'ABILITY_SCRIPTS_CREATE'                        => true,
    'ABILITY_SCRIPTS_UPDATE'                        => false,
    'ABILITY_SCRIPTS_DELETE'                        => true,
    'ABILITY_ATTACHMENTS_VIEW'                      => true,
    'ABILITY_ATTACHMENTS_CREATE'                    => true,
    'ABILITY_ATTACHMENTS_UPDATE'                    => false,
    'ABILITY_ATTACHMENTS_DELETE'                    => true,
    'ABILITY_SMS_CUST_FROM_NAME'                    => true,
    'ABILITY_LABELS_VIEW'                           => true,
    'ABILITY_LABELS_CREATE'                         => true,
    'ABILITY_LABELS_UPDATE'                         => false,
    'ABILITY_LABELS_DELETE'                         => true,
    'ABILITY_FILTERS_VIEW'                          => true,
    'ABILITY_FILTERS_CREATE'                        => true,
    'ABILITY_FILTERS_UPDATE'                        => false,
    'ABILITY_FILTERS_DELETE'                        => true,
    'ABILITY_CONTACTS_BULK_IMPORT'                  => true,
    'ABILITY_CONTACTS_SAVED_SEARCH'                 => true,
    'ABILITY_CONTACTS_EMAIL'                        => true,
    'ABILITY_CONTACTS_SMS'                          => true,
    'ABILITY_CONTACTS_LINK_ORG'                     => true,
    'ABILITY_FORMS_GA_INTEGRATION'                  => true,
    'ABILITY_FORMS_FILE_UPLOAD'                     => true,
    'ABILITY_FORMS_GTM_INTEGRATION'                 => true,
    'ABILITY_FORMS_CSS_CUST'                        => true,
    'ABILITY_FORMS_SHOW_HIDE_FIELDS'                => true,
    'ABILITY_FORMS_MULTI_PAGE'                      => true,
    'ABILITY_FORMS_INSTANT_SMS'                     => true,
    'ABILITY_FORMS_DELAYED_MARKETING'               => true,
    'ABILITY_FORMS_ADDR_LOOKUP'                     => true,
    'ABILITY_FORMS_BRANDING_PER_PAGE'               => true,
    'ABILITY_FORMS_SHARE_PAGE'                      => true,
    'ABILITY_RESPONSES_REAL_TIME'                   => true,
    'ABILITY_RESPONSES_ASSIGN_TO_COLLEAGUES'        => true,
    'ABILITY_RESPONSES_BULK_IMPORT'                 => true,
    'ABILITY_USERS_PERMISSION_GROUPS'               => true,
    'ABILITY_USERS_GRANULAR_PERMISSIONS'            => true,
    'ABILITY_AUDIT'                                 => true,
    'ABILITY_API_ACCESS'                            => true,
    'ABILITY_EVENTS_DASHBOARD'                      => true,
    'ABILITY_EVENTS_ATTENDEE_QRS'                   => true,
    'ABILITY_EVENTS_AUTO_MARKETING_MSG'             => true,
    'ABILITY_EVENTS_LANDING_PAGES'                  => true,
    'ABILITY_EVENTS_BOOKING_SELF_SERVICE'           => true,
    'ABILITY_EVENTS_ATTENDEE_SCAN'                  => true,
    'ABILITY_EVENTS_SHARE_TAB'                      => true,
    'ABILITY_EVENTS_SESSIONS_TAB'                   => true,
    'ABILITY_EVENTS_RSVP_CHECKIN'                   => true,
    'ABILITY_EVENTS_WORKFLOWS_TAB'                  => true,
    'ABILITY_EVENTS_BRANDING'                       => true,
    'ABILITY_REPEATING_EVENT'                       => true,
    'ABILITY_EVENTS_VIDEO_STREAMING'                => true,
    'ABILITY_HOSTS_VIEW'                            => true,
    'ABILITY_HOSTS_CREATE'                          => true,
    'ABILITY_HOSTS_UPDATE'                          => false,
    'ABILITY_HOSTS_DELETE'                          => true,
    'ABILITY_LOCATIONS_VIEW'                        => true,
    'ABILITY_LOCATIONS_CREATE'                      => true,
    'ABILITY_LOCATIONS_UPDATE'                      => false,
    'ABILITY_LOCATIONS_DELETE'                      => true,
    'ABILITY_CATEGORIES_VIEW'                       => true,
    'ABILITY_CATEGORIES_CREATE'                     => true,
    'ABILITY_CATEGORIES_UPDATE'                     => false,
    'ABILITY_CATEGORIES_DELETE'                     => true,
    'ABILITY_FTP_IMPORT'                            => true,
    'ABILITY_RECURRING_IMPORT'                      => true,
    'ABILITY_MESSAGE_STATS'                         => true,
    'ABILITY_WEBHOOK_INTEGRATION'                   => true,
    'ABILITY_CONSENTS_VIEW'                         => true,
    'ABILITY_CONSENTS_FIELD'                        => true,
    'ABILITY_CONSENTS_CREATE'                       => true,
    'ABILITY_CONSENTS_UPDATE'                       => false,
    'ABILITY_CONSENTS_DELETE'                       => true,
    'ABILITY_PORTAL_CONTACT'                        => true,
    'ABILITY_AUTO_ARCHIVE'                          => true,
    'ABILITY_PORTAL_AUTH'                           => true,
    'ABILITY_GDPR'                                  => true,
    'ABILITY_SKIP_GDPR_BLOCK'                       => true,
    'ABILITY_TEMPLATES_DRAGDROP'                    => true,
    'ABILITY_IMPOSSIBLE'                            => true,
    'ABILITY_VERIFIED_DOMAINS_VIEW'                 => true,
    'ABILITY_VERIFIED_DOMAINS_CREATE'               => true,
    'ABILITY_VERIFIED_DOMAINS_UPDATE'               => false,
    'ABILITY_VERIFIED_DOMAINS_DELETE'               => true,
    'ABILITY_ANOTHER'                               => true,
    'ABILITY_ANOTHER_A'                             => true,
    'ABILITY_ANOTHER_B'                             => true,
    'firstHex'                                      => 'AB67F', // Fixed
    'secondHex'                                     => 'abcdef12345', // Variable
    'thirdHex'                                      => 'ABCDEF123453391FC7C520D4BBF8A98705781B7F8553B6D44B263074E94A5D4A7E011D8E93C',
    'uuidOne'                                       => 'DE9F6D0A-2DCE-4E9B-ABED-F6002E5E173F',
    'uuidTwo'                                       => '31f8260f-ac42-419f-9a07-6fd70031988a',
    'uuidThree'                                     => '0f87e8db-7658-47e1-bca7-bd23e03a2959',
    'uuidFour'                                      => 'd70ce67f-a6d3-472d-8da7-2afa7113241e',
    'uuidFive'                                      => '46d0e3f1-806c-436e-ab28-fe729ede6f0b',
    'alpha'                                         => 'This Is 1 Big Long alphanumeric Sentence with numbers and spaces and stuff like that',
];

section('JSON & Base64 encoding');

lines(
    'JSON encoded values',
    json_encode($values),
    size(json_encode($values)),
);
wait();

lines(
    '',
    'Base64 encoded',
    base64_encode(json_encode($values)),
    size(base64_encode(json_encode($values))),
);

wait();




















$index = new Index(
    (new Hexadecimal(1))->setValue('A'),
    [
        'ABILITY_RESPONSES_VIEW'                            => new Boolean(),
        'ABILITY_RESPONSES_CREATE'                          => new Boolean(),
        'ABILITY_RESPONSES_UPDATE'                          => new Boolean(),
        'ABILITY_RESPONSES_DELETE'                          => new Boolean(),
        'ABILITY_RESPONSES_EXPORT'                          => new Boolean(),
        'ABILITY_CONTACTS_UNSUBSCRIBE'                      => new Boolean(),
        'ABILITY_CONTACTS_VIEW'                             => new Boolean(),
        'ABILITY_CONTACTS_CREATE'                           => new Boolean(),
        'ABILITY_CONTACTS_UPDATE'                           => new Boolean(),
        'ABILITY_CONTACTS_DELETE'                           => new Boolean(),
        'ABILITY_DASHBOARDS_VIEW'                           => new Boolean(),
        'ABILITY_DASHBOARDS_CREATE'                         => new Boolean(),
        'ABILITY_DASHBOARDS_UPDATE'                         => new Boolean(),
        'ABILITY_DASHBOARDS_DELETE'                         => new Boolean(),
        'ABILITY_CONTACT_DASHBOARD'                         => new Boolean(),
        'ABILITY_DEVICES_VIEW'                              => new Boolean(),
        'ABILITY_DEVICES_CREATE'                            => new Boolean(),
        'ABILITY_DEVICES_UPDATE'                            => new Boolean(),
        'ABILITY_DEVICES_DELETE'                            => new Boolean(),
        'ABILITY_EXPORTS'                                   => new Boolean(),
        'ABILITY_EXPORT_RECIPIENTS'                         => new Boolean(),
        'ABILITY_FORMS_VIEW'                                => new Boolean(),
        'ABILITY_FORMS_CREATE'                              => new Boolean(),
        'ABILITY_FORMS_UPDATE'                              => new Boolean(),
        'ABILITY_FORMS_DELETE'                              => new Boolean(),
        'ABILITY_IMPORTS'                                   => new Boolean(),
        'ABILITY_USERS_VIEW'                                => new Boolean(),
        'ABILITY_USERS_CREATE'                              => new Boolean(),
        'ABILITY_USERS_UPDATE'                              => new Boolean(),
        'ABILITY_USERS_DELETE'                              => new Boolean(),
        'ABILITY_USERS_INVITE'                              => new Boolean(),
        'ABILITY_ENROLMENTS_VIEW'                           => new Boolean(),
        'ABILITY_ENROLMENTS_CREATE'                         => new Boolean(),
        'ABILITY_ENROLMENTS_UPDATE'                         => new Boolean(),
        'ABILITY_ENROLMENTS_DELETE'                         => new Boolean(),
        'ABILITY_EVENTS_VIEW'                               => new Boolean(),
        'ABILITY_EVENTS_CREATE'                             => new Boolean(),
        'ABILITY_EVENTS_UPDATE'                             => new Boolean(),
        'ABILITY_EVENTS_DELETE'                             => new Boolean(),
        'ABILITY_FIELDS_VIEW'                               => new Boolean(),
        'ABILITY_FIELDS_CREATE'                             => new Boolean(),
        'ABILITY_FIELDS_UPDATE'                             => new Boolean(),
        'ABILITY_FIELDS_DELETE'                             => new Boolean(),
        'ABILITY_FILES_VIEW'                                => new Boolean(),
        'ABILITY_FILES_CREATE'                              => new Boolean(),
        'ABILITY_FILES_UPDATE'                              => new Boolean(),
        'ABILITY_FILES_DELETE'                              => new Boolean(),
        'ABILITY_GROUPS_VIEW'                               => new Boolean(),
        'ABILITY_GROUPS_CREATE'                             => new Boolean(),
        'ABILITY_GROUPS_UPDATE'                             => new Boolean(),
        'ABILITY_GROUPS_DELETE'                             => new Boolean(),
        'ABILITY_INTEGRATIONS_VIEW'                         => new Boolean(),
        'ABILITY_INTEGRATIONS_CREATE'                       => new Boolean(),
        'ABILITY_INTEGRATIONS_UPDATE'                       => new Boolean(),
        'ABILITY_INTEGRATIONS_DELETE'                       => new Boolean(),
        'ABILITY_INTERACTIONS_VIEW'                         => new Boolean(),
        'ABILITY_INTERACTIONS_CREATE'                       => new Boolean(),
        'ABILITY_INTERACTIONS_UPDATE'                       => new Boolean(),
        'ABILITY_INTERACTIONS_DELETE'                       => new Boolean(),
        'ABILITY_MEDIA_VIEW'                                => new Boolean(),
        'ABILITY_MEDIA_CREATE'                              => new Boolean(),
        'ABILITY_MEDIA_UPDATE'                              => new Boolean(),
        'ABILITY_MEDIA_DELETE'                              => new Boolean(),
        'ABILITY_MESSAGES_VIEW'                             => new Boolean(),
        'ABILITY_MESSAGES_CREATE'                           => new Boolean(),
        'ABILITY_MESSAGES_UPDATE'                           => new Boolean(),
        'ABILITY_MESSAGES_DELETE'                           => new Boolean(),
        'ABILITY_NOTES_VIEW'                                => new Boolean(),
        'ABILITY_NOTES_CREATE'                              => new Boolean(),
        'ABILITY_NOTES_UPDATE'                              => new Boolean(),
        'ABILITY_NOTES_DELETE'                              => new Boolean(),
        'ABILITY_NUMBERS_VIEW'                              => new Boolean(),
        'ABILITY_NUMBERS_CREATE'                            => new Boolean(),
        'ABILITY_NUMBERS_UPDATE'                            => new Boolean(),
        'ABILITY_NUMBERS_DELETE'                            => new Boolean(),
        'ABILITY_OPTIONS_CREATE'                            => new Boolean(),
        'ABILITY_OPTIONS_UPDATE'                            => new Boolean(),
        'ABILITY_OPTIONS_DELETE'                            => new Boolean(),
        'ABILITY_OUTCOMES_VIEW'                             => new Boolean(),
        'ABILITY_OUTCOMES_CREATE'                           => new Boolean(),
        'ABILITY_OUTCOMES_UPDATE'                           => new Boolean(),
        'ABILITY_OUTCOMES_DELETE'                           => new Boolean(),
        'ABILITY_OUTCOMES_CUSTOM'                           => new Boolean(),
        'ABILITY_SCHEDULES_VIEW'                            => new Boolean(),
        'ABILITY_SCHEDULES_CREATE'                          => new Boolean(),
        'ABILITY_SCHEDULES_UPDATE'                          => new Boolean(),
        'ABILITY_SCHEDULES_DELETE'                          => new Boolean(),
        'ABILITY_SENDERS_VIEW'                              => new Boolean(),
        'ABILITY_SENDERS_CREATE'                            => new Boolean(),
        'ABILITY_SENDERS_UPDATE'                            => new Boolean(),
        'ABILITY_SENDERS_DELETE'                            => new Boolean(),
        'ABILITY_SENDERS_VOIP'                              => new Boolean(),
        'ABILITY_SUBSCRIBERS_VIEW'                          => new Boolean(),
        'ABILITY_SUBSCRIBERS_CREATE'                        => new Boolean(),
        'ABILITY_SUBSCRIBERS_UPDATE'                        => new Boolean(),
        'ABILITY_SUBSCRIBERS_DELETE'                        => new Boolean(),
        'ABILITY_TEMPLATES_VIEW'                            => new Boolean(),
        'ABILITY_TEMPLATES_CREATE'                          => new Boolean(),
        'ABILITY_TEMPLATES_UPDATE'                          => new Boolean(),
        'ABILITY_TEMPLATES_DELETE'                          => new Boolean(),
        'ABILITY_TRANSACTIONS_VIEW'                         => new Boolean(),
        'ABILITY_TRANSACTIONS_CREATE'                       => new Boolean(),
        'ABILITY_TRANSACTIONS_UPDATE'                       => new Boolean(),
        'ABILITY_TRANSACTIONS_DELETE'                       => new Boolean(),
        'ABILITY_TWILIO'                                    => new Boolean(),
        'ABILITY_VALUES_VIEW'                               => new Boolean(),
        'ABILITY_VALUES_CREATE'                             => new Boolean(),
        'ABILITY_VALUES_UPDATE'                             => new Boolean(),
        'ABILITY_VALUES_DELETE'                             => new Boolean(),
        'ABILITY_WIDGETS_VIEW'                              => new Boolean(),
        'ABILITY_WIDGETS_CREATE'                            => new Boolean(),
        'ABILITY_WIDGETS_UPDATE'                            => new Boolean(),
        'ABILITY_WIDGETS_DELETE'                            => new Boolean(),
        'ABILITY_WORKFLOWS_VIEW'                            => new Boolean(),
        'ABILITY_WORKFLOWS_CREATE'                          => new Boolean(),
        'ABILITY_WORKFLOWS_UPDATE'                          => new Boolean(),
        'ABILITY_WORKFLOWS_DELETE'                          => new Boolean(),
        'ABILITY_ORGANISATIONS_VIEW'                        => new Boolean(),
        'ABILITY_ORGANISATIONS_CREATE'                      => new Boolean(),
        'ABILITY_ORGANISATIONS_UPDATE'                      => new Boolean(),
        'ABILITY_ORGANISATIONS_DELETE'                      => new Boolean(),
        'ABILITY_LANDING_PAGES_VIEW'                        => new Boolean(),
        'ABILITY_LANDING_PAGES_CREATE'                      => new Boolean(),
        'ABILITY_LANDING_PAGES_UPDATE'                      => new Boolean(),
        'ABILITY_LANDING_PAGES_DELETE'                      => new Boolean(),
        'ABILITY_CALLS_VIEW'                                => new Boolean(),
        'ABILITY_CALLS_CREATE'                              => new Boolean(),
        'ABILITY_CALLS_UPDATE'                              => new Boolean(),
        'ABILITY_CALLS_DELETE'                              => new Boolean(),
        'ABILITY_CALLS_LISTEN'                              => new Boolean(),
        'ABILITY_CALL_CAMPAIGNS_VIEW'                       => new Boolean(),
        'ABILITY_CALL_CAMPAIGNS_CREATE'                     => new Boolean(),
        'ABILITY_CALL_CAMPAIGNS_UPDATE'                     => new Boolean(),
        'ABILITY_CALL_CAMPAIGNS_DELETE'                     => new Boolean(),
        'ABILITY_BROADCASTS_VIEW'                           => new Boolean(),
        'ABILITY_BROADCASTS_CREATE'                         => new Boolean(),
        'ABILITY_BROADCASTS_UPDATE'                         => new Boolean(),
        'ABILITY_BROADCASTS_DELETE'                         => new Boolean(),
        'ABILITY_SMS_BROADCASTS_VIEW'                       => new Boolean(),
        'ABILITY_SMS_BROADCASTS_CREATE'                     => new Boolean(),
        'ABILITY_SMS_BROADCASTS_UPDATE'                     => new Boolean(),
        'ABILITY_SMS_BROADCASTS_DELETE'                     => new Boolean(),
        'ABILITY_EMAIL_BROADCASTS_VIEW'                     => new Boolean(),
        'ABILITY_EMAIL_BROADCASTS_CREATE'                   => new Boolean(),
        'ABILITY_EMAIL_BROADCASTS_UPDATE'                   => new Boolean(),
        'ABILITY_EMAIL_BROADCASTS_DELETE'                   => new Boolean(),
        'ABILITY_SCRIPTS_VIEW'                              => new Boolean(),
        'ABILITY_SCRIPTS_CREATE'                            => new Boolean(),
        'ABILITY_SCRIPTS_UPDATE'                            => new Boolean(),
        'ABILITY_SCRIPTS_DELETE'                            => new Boolean(),
        'ABILITY_ATTACHMENTS_VIEW'                          => new Boolean(),
        'ABILITY_ATTACHMENTS_CREATE'                        => new Boolean(),
        'ABILITY_ATTACHMENTS_UPDATE'                        => new Boolean(),
        'ABILITY_ATTACHMENTS_DELETE'                        => new Boolean(),
        'ABILITY_SMS_CUST_FROM_NAME'                        => new Boolean(),
        'ABILITY_LABELS_VIEW'                               => new Boolean(),
        'ABILITY_LABELS_CREATE'                             => new Boolean(),
        'ABILITY_LABELS_UPDATE'                             => new Boolean(),
        'ABILITY_LABELS_DELETE'                             => new Boolean(),
        'ABILITY_FILTERS_VIEW'                              => new Boolean(),
        'ABILITY_FILTERS_CREATE'                            => new Boolean(),
        'ABILITY_FILTERS_UPDATE'                            => new Boolean(),
        'ABILITY_FILTERS_DELETE'                            => new Boolean(),
        'ABILITY_CONTACTS_BULK_IMPORT'                      => new Boolean(),
        'ABILITY_CONTACTS_SAVED_SEARCH'                     => new Boolean(),
        'ABILITY_CONTACTS_EMAIL'                            => new Boolean(),
        'ABILITY_CONTACTS_SMS'                              => new Boolean(),
        'ABILITY_CONTACTS_LINK_ORG'                         => new Boolean(),
        'ABILITY_FORMS_GA_INTEGRATION'                      => new Boolean(),
        'ABILITY_FORMS_FILE_UPLOAD'                         => new Boolean(),
        'ABILITY_FORMS_GTM_INTEGRATION'                     => new Boolean(),
        'ABILITY_FORMS_CSS_CUST'                            => new Boolean(),
        'ABILITY_FORMS_SHOW_HIDE_FIELDS'                    => new Boolean(),
        'ABILITY_FORMS_MULTI_PAGE'                          => new Boolean(),
        'ABILITY_FORMS_INSTANT_SMS'                         => new Boolean(),
        'ABILITY_FORMS_DELAYED_MARKETING'                   => new Boolean(),
        'ABILITY_FORMS_ADDR_LOOKUP'                         => new Boolean(),
        'ABILITY_FORMS_BRANDING_PER_PAGE'                   => new Boolean(),
        'ABILITY_FORMS_SHARE_PAGE'                          => new Boolean(),
        'ABILITY_RESPONSES_REAL_TIME'                       => new Boolean(),
        'ABILITY_RESPONSES_ASSIGN_TO_COLLEAGUES'            => new Boolean(),
        'ABILITY_RESPONSES_BULK_IMPORT'                     => new Boolean(),
        'ABILITY_USERS_PERMISSION_GROUPS'                   => new Boolean(),
        'ABILITY_USERS_GRANULAR_PERMISSIONS'                => new Boolean(),
        'ABILITY_AUDIT'                                     => new Boolean(),
        'ABILITY_API_ACCESS'                                => new Boolean(),
        'ABILITY_EVENTS_DASHBOARD'                          => new Boolean(),
        'ABILITY_EVENTS_ATTENDEE_QRS'                       => new Boolean(),
        'ABILITY_EVENTS_AUTO_MARKETING_MSG'                 => new Boolean(),
        'ABILITY_EVENTS_LANDING_PAGES'                      => new Boolean(),
        'ABILITY_EVENTS_BOOKING_SELF_SERVICE'               => new Boolean(),
        'ABILITY_EVENTS_ATTENDEE_SCAN'                      => new Boolean(),
        'ABILITY_EVENTS_SHARE_TAB'                          => new Boolean(),
        'ABILITY_EVENTS_SESSIONS_TAB'                       => new Boolean(),
        'ABILITY_EVENTS_RSVP_CHECKIN'                       => new Boolean(),
        'ABILITY_EVENTS_WORKFLOWS_TAB'                      => new Boolean(),
        'ABILITY_EVENTS_BRANDING'                           => new Boolean(),
        'ABILITY_REPEATING_EVENT'                           => new Boolean(),
        'ABILITY_EVENTS_VIDEO_STREAMING'                    => new Boolean(),
        'ABILITY_HOSTS_VIEW'                                => new Boolean(),
        'ABILITY_HOSTS_CREATE'                              => new Boolean(),
        'ABILITY_HOSTS_UPDATE'                              => new Boolean(),
        'ABILITY_HOSTS_DELETE'                              => new Boolean(),
        'ABILITY_LOCATIONS_VIEW'                            => new Boolean(),
        'ABILITY_LOCATIONS_CREATE'                          => new Boolean(),
        'ABILITY_LOCATIONS_UPDATE'                          => new Boolean(),
        'ABILITY_LOCATIONS_DELETE'                          => new Boolean(),
        'ABILITY_CATEGORIES_VIEW'                           => new Boolean(),
        'ABILITY_CATEGORIES_CREATE'                         => new Boolean(),
        'ABILITY_CATEGORIES_UPDATE'                         => new Boolean(),
        'ABILITY_CATEGORIES_DELETE'                         => new Boolean(),
        'ABILITY_FTP_IMPORT'                                => new Boolean(),
        'ABILITY_RECURRING_IMPORT'                          => new Boolean(),
        'ABILITY_MESSAGE_STATS'                             => new Boolean(),
        'ABILITY_WEBHOOK_INTEGRATION'                       => new Boolean(),
        'ABILITY_CONSENTS_VIEW'                             => new Boolean(),
        'ABILITY_CONSENTS_FIELD'                            => new Boolean(),
        'ABILITY_CONSENTS_CREATE'                           => new Boolean(),
        'ABILITY_CONSENTS_UPDATE'                           => new Boolean(),
        'ABILITY_CONSENTS_DELETE'                           => new Boolean(),
        'ABILITY_PORTAL_CONTACT'                            => new Boolean(),
        'ABILITY_AUTO_ARCHIVE'                              => new Boolean(),
        'ABILITY_PORTAL_AUTH'                               => new Boolean(),
        'ABILITY_GDPR'                                      => new Boolean(),
        'ABILITY_SKIP_GDPR_BLOCK'                           => new Boolean(),
        'ABILITY_TEMPLATES_DRAGDROP'                        => new Boolean(),
        'ABILITY_IMPOSSIBLE'                                => new Boolean(),
        'ABILITY_VERIFIED_DOMAINS_VIEW'                     => new Boolean(),
        'ABILITY_VERIFIED_DOMAINS_CREATE'                   => new Boolean(),
        'ABILITY_VERIFIED_DOMAINS_UPDATE'                   => new Boolean(),
        'ABILITY_VERIFIED_DOMAINS_DELETE'                   => new Boolean(),
        'ABILITY_ANOTHER'                                   => new Boolean(),
        'ABILITY_ANOTHER_A'                                 => new Boolean(),
        'ABILITY_ANOTHER_B'                                 => new Boolean(),
        'firstHex'                                          => new Hexadecimal(5),
        'secondHex'                                         => new Hexadecimal(0, false),
        'thirdHex'                                          => new Hexadecimal(0, true),
        'uuidOne'                                           => new UUID(),
        'uuidTwo'                                           => new UUID(),
        'uuidThree'                                         => new UUID(),
        'uuidFour'                                          => new UUID(),
        'uuidFive'                                          => new UUID(),
        'alpha'                                             => new Alphanumeric(0, true),
    ]
);


















$semaphore = new Semaphore(
    new Hexadecimal(1),
    new Library($index),
    CharacterSets::SAFER_ASCII
);

$encoded = $semaphore->encodeValues('A', $values);

lines(
    '',
    '',
    '',
    'Encoded with "SAFER ASCII"',
    '',
    $encoded,
    size($encoded),
    '',
    'Base64 Encoded',
    base64_encode($encoded),
    size(base64_encode($encoded)),
);

wait();





























$semaphore = new Semaphore(
    new Hexadecimal(1),
    new Library($index),
    CharacterSets::SAFER_ASCII_SHUFFLED
);

$encoded = $semaphore->encodeValues('A', $values);

lines(
    '',
    '',
    '',
    'Encoded with "SAFER ASCII" *SHUFFLED*',
    '',
    $encoded,
    size($encoded),
    '',
    'Base64 Encoded',
    base64_encode($encoded),
    size(base64_encode($encoded)),
);

wait();























$semaphore = new Semaphore(
    new Hexadecimal(1),
    new Library($index),
    CharacterSets::HEXADECIMAL
);

$encoded = $semaphore->encodeValues('A', $values);

lines(
    '',
    '',
    '',
    'Encoded with "HEXADECIMAL"',
    '',
    $encoded,
    size($encoded),
    '',
    'Base64 Encoded',
    base64_encode($encoded),
    size(base64_encode($encoded)),
);

wait();


























$decoded = $semaphore->decodeValues($encoded);

values($decoded);


wait();





































lines(
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    'Thanks for coming to my ted talk',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
);
