<?php

namespace App\Traits;

use Docusign as Docusigner;

trait DocuSign 
{
    public $template;

    public function processTemplate ($data)
    {   
        $templates = Docusigner::getTemplates();

        $template = array_filter($templates, fn($templateItem) => trim($templateItem['name']) == trim($data['templateName']));
        
        return Docusigner::createEnvelope(array(
                            'templateId'     => $template[0]['templateId'],
                            'emailSubject'   => $data['subject'],
                            'status'         => 'created',
                            'templateRoles'  => array(
                                                        [
                                                            'name'    => $data['name'],
                                                            'email'    => $data['email'],
                                                            'roleName' => $data['role']
                                                        ]
                                                )
                            ));
        
    }
    
    public function getEnvelop ($envelopId = null)
    {
        return Docusigner::getEnvelope($envelopId);
    }
}
