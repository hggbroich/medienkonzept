<?php

namespace App\Security\User;

use JsonException;
use LightSaml\ClaimTypes;
use LightSaml\Model\Protocol\Response;
use LightSaml\SpBundle\Security\User\AttributeMapperInterface;
use SchulIT\CommonBundle\Saml\ClaimTypes as SamlClaimTypes;
use SchulIT\CommonBundle\Security\User\AbstractUserMapper;
use stdClass;

class AttributeMapper extends AbstractUserMapper implements AttributeMapperInterface {

    /**
     * @param Response $response
     * @return array<string, mixed>
     * @throws JsonException
     */
    public function getAttributes(Response $response): array {
        $attributes = [ ];

        foreach($response->getFirstAssertion()->getFirstAttributeStatement()->getAllAttributes() as $attribute) {
            $values = $attribute->getAllAttributeValues();

            if(count($values) > 1) {
                $attributes[$attribute->getName()] = $values;
            } else if(count($values) === 1) {
                $attributes[$attribute->getName()] = $values[0];
            } else {
                $attributes[$attribute->getName()] = null;
            }
        }

        $attributes['name_id'] = $response->getFirstAssertion()->getSubject()->getNameID()->getValue();
        $attributes['services'] = $this->getServices($response);

        return $attributes;
    }

    /**
     * @return array<stdClass>
     * @throws JsonException
     */
    private function getServices(Response $response): array {
        $values = $response->getFirstAssertion()->getFirstAttributeStatement()
            ->getFirstAttributeByName(SamlClaimTypes::SERVICES)->getAllAttributeValues();

        $services = [ ];

        foreach($values as $value) {
            $services[] = json_decode($value, associative: null);
        }

        return $services;
    }
}