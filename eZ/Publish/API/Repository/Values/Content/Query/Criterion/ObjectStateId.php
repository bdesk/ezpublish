<?php
/**
 * File containing the eZ\Publish\API\Repository\Values\Content\Query\Criterion\ObjectStateId class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\API\Repository\Values\Content\Query\Criterion;

use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion\Operator\Specifications;
use eZ\Publish\API\Repository\Values\Content\Query\CriterionInterface;

/**
 * A criterion that matches content based on its state
 *
 * Supported operators:
 * - IN: matches against a list of object state IDs
 * - EQ: matches against one object state ID
 */
class ObjectStateId extends Criterion implements CriterionInterface
{
    /**
     * Creates a new ObjectStateId criterion
     *
     * @param int|int[] $value One or more object state IDs that must be matched
     *
     * @throws \InvalidArgumentException if a non numeric id is given
     * @throws \InvalidArgumentException if the value type doesn't match the operator
     */
    public function __construct( $value )
    {
        parent::__construct( null, null, $value );
    }

    public function getSpecifications()
    {
        return array(
            new Specifications(
                Operator::IN,
                Specifications::FORMAT_ARRAY,
                Specifications::TYPE_INTEGER | Specifications::TYPE_STRING
            ),
            new Specifications(
                Operator::EQ,
                Specifications::FORMAT_SINGLE,
                Specifications::TYPE_INTEGER | Specifications::TYPE_STRING
            ),
        );
    }

    public static function createFromQueryBuilder( $target, $operator, $value )
    {
        return new self( $value );
    }
}
