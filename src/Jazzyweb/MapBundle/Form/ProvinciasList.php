<?php

namespace Jazzyweb\MapBundle\Form;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;

class ProvinciasList implements ChoiceListInterface {
    /**
     * Returns the list of choices
     *
     * @return array The choices with their indices as keys
     */
    public function getChoices()
    {
        // TODO: Implement getChoices() method.
    }

    /**
     * Returns the values for the choices
     *
     * @return array The values with the corresponding choice indices as keys
     */
    public function getValues()
    {
        // TODO: Implement getValues() method.
    }

    /**
     * Returns the choice views of the preferred choices as nested array with
     * the choice groups as top-level keys.
     *
     * Example:
     *
     * <source>
     * array(
     *     'Group 1' => array(
     *         10 => ChoiceView object,
     *         20 => ChoiceView object,
     *     ),
     *     'Group 2' => array(
     *         30 => ChoiceView object,
     *     ),
     * )
     * </source>
     *
     * @return array A nested array containing the views with the corresponding
     *               choice indices as keys on the lowest levels and the choice
     *               group names in the keys of the higher levels
     */
    public function getPreferredViews()
    {
        // TODO: Implement getPreferredViews() method.
    }

    /**
     * Returns the choice views of the choices that are not preferred as nested
     * array with the choice groups as top-level keys.
     *
     * Example:
     *
     * <source>
     * array(
     *     'Group 1' => array(
     *         10 => ChoiceView object,
     *         20 => ChoiceView object,
     *     ),
     *     'Group 2' => array(
     *         30 => ChoiceView object,
     *     ),
     * )
     * </source>
     *
     * @return array A nested array containing the views with the corresponding
     *               choice indices as keys on the lowest levels and the choice
     *               group names in the keys of the higher levels
     *
     * @see getPreferredValues
     */
    public function getRemainingViews()
    {
        // TODO: Implement getRemainingViews() method.
    }

    /**
     * Returns the choices corresponding to the given values.
     *
     * The choices can have any data type.
     *
     * The choices must be returned with the same keys and in the same order
     * as the corresponding values in the given array.
     *
     * @param array $values An array of choice values. Not existing values in
     *                      this array are ignored
     *
     * @return array An array of choices with ascending, 0-based numeric keys
     */
    public function getChoicesForValues(array $values)
    {
        // TODO: Implement getChoicesForValues() method.
    }

    /**
     * Returns the values corresponding to the given choices.
     *
     * The values must be strings.
     *
     * The values must be returned with the same keys and in the same order
     * as the corresponding choices in the given array.
     *
     * @param array $choices An array of choices. Not existing choices in this
     *                       array are ignored
     *
     * @return array An array of choice values with ascending, 0-based numeric
     *               keys
     */
    public function getValuesForChoices(array $choices)
    {
        // TODO: Implement getValuesForChoices() method.
    }

    /**
     * Returns the indices corresponding to the given choices.
     *
     * The indices must be positive integers or strings accepted by
     * {@link FormConfigBuilder::validateName()}.
     *
     * The index "placeholder" is internally reserved.
     *
     * The indices must be returned with the same keys and in the same order
     * as the corresponding choices in the given array.
     *
     * @param array $choices An array of choices. Not existing choices in this
     *                       array are ignored
     *
     * @return array An array of indices with ascending, 0-based numeric keys
     *
     * @deprecated Deprecated since version 2.4, to be removed in 3.0.
     */
    public function getIndicesForChoices(array $choices)
    {
        // TODO: Implement getIndicesForChoices() method.
    }

    /**
     * Returns the indices corresponding to the given values.
     *
     * The indices must be positive integers or strings accepted by
     * {@link FormConfigBuilder::validateName()}.
     *
     * The index "placeholder" is internally reserved.
     *
     * The indices must be returned with the same keys and in the same order
     * as the corresponding values in the given array.
     *
     * @param array $values An array of choice values. Not existing values in
     *                      this array are ignored
     *
     * @return array An array of indices with ascending, 0-based numeric keys
     *
     * @deprecated Deprecated since version 2.4, to be removed in 3.0.
     */
    public function getIndicesForValues(array $values)
    {
        // TODO: Implement getIndicesForValues() method.
    }

}
