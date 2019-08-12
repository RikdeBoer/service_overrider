<?php

namespace Drupal\service_overrider\EventSubscriber;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Drupal\rest\EventSubscriber\ResourceResponseSubscriber;
use Drupal\rest\ResourceResponseInterface;

/**
 * ResourceResponsesSubscriber override to set CSV filename when exported.
 */
class AltResourceResponseSubscriber extends ResourceResponseSubscriber {

  /**
   * {@inheritdoc}
   */
  protected function renderResponseBody(Request $request, ResourceResponseInterface $response, SerializerInterface $serializer, $format) {
    $result = parent::renderResponseBody($request, $response, $serializer, $format);
    if ($format == 'csv') {
      // Change path like "/path1/path2/param1"to "path1-path2-param1".
      $filename = str_replace('/', '-', substr($request->getPathInfo(), 1));
      $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '.csv"');
    }
    return $result;
  }

}
