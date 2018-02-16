<?php

namespace Oro\Bundle\CalendarBundle\Form\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\CalendarBundle\Entity\CalendarProperty;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CalendarPropertyApiHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param FormInterface $form
     * @param RequestStack  $requestStack
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, RequestStack $requestStack, ObjectManager $manager)
    {
        $this->form = $form;
        $this->requestStack = $requestStack;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param  CalendarProperty $entity
     *
     * @return bool True on successful processing, false otherwise
     */
    public function process(CalendarProperty $entity)
    {
        $this->form->setData($entity);

        $request = $this->requestStack->getCurrentRequest();
        if (in_array($request->getMethod(), ['POST', 'PUT'], true)) {
            $this->form->submit($request);

            if ($this->form->isValid()) {
                $this->onSuccess($entity);

                return true;
            }
        }

        return false;
    }

    /**
     * "Success" form handler
     *
     * @param CalendarProperty $entity
     */
    protected function onSuccess(CalendarProperty $entity)
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }
}
