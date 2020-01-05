<?php

namespace RasTeixeiraTests\MessDetector;

class CleanCodeTest
{
    /**
     * A boolean flag argument is a reliable indicator for a violation 
     * of the Single Responsibility Principle (SRP). You can fix this problem 
     * by extracting the logic in the boolean flag into its own class or method.
     *
     * @param boolean $foo
     * @return void
     */
    public function booleanArgumentFlag(bool $foo = true): void
    {
        if ($foo) {
            $bar = 1;
            unset($bar);
        }
    }

    /**
     * An if expression with an else branch is basically not necessary.
     * You can rewrite the conditions in a way that the else clause 
     * is not necessary and the code becomes simpler to read. To achieve this, 
     * use early return statements, though you may need to split the code 
     * in several smaller methods. For very simple assignments you could 
     * also use the ternary operations.
     *
     * @param any $flag
     * @return void
     */
    public function elseExpression($flag): void
    {
        if ($flag) {
            // one branch
        } else {
            // another branch
        }
    }

    /**
     * Static access causes unexchangeable dependencies to other classes 
     * and leads to hard to test code. Avoid using static access at all costs 
     * and instead inject dependencies through the constructor. The only case 
     * when static access is acceptable is when used for factory methods.
     *
     * @return void
     */
    public function staticAccess()
    {
        Bar::baz();
    }

    /**
     * Assignments in if clauses and the like are considered a code smell. 
     * Assignments in PHP return the right operand as their result. In many cases, 
     * this is an expected behavior, but can lead to many difficult to spot bugs, 
     * especially when the right operand could result in zero, null or an empty string.
     *
     * @param [type] $flag
     * @return void
     */
    public function iFStatementAssignment()
    {
        if ($foo = 'bar') { // possible typo
            $foo;
        }
        if ($baz = 0) { // always false
            $baz;
        }
    }

    /**
     * Defining another value for the same key in an array literal overrides 
     * the previous key/value, which makes it effectively an unused code. 
     * If it's known from the beginning that the key will have different value, 
     * there is usually no point in defining first one.
     *
     * @return array
     */
    public function duplicatedArrayKey(): array
    {
        return [
            'non-associative 0-element', // not applied
            0 => 'associative 0-element', // applied
            false => 'associative 0-element', // applied
            'foo' => 'bar', // not applied
            "foo" => 'baz', // applied
        ];
    }

    /**
     * Importing all external classes in a file through use statements 
     * makes them clearly visible.
     *
     * @return void
     */
    public function missingImport()
    {
        return new \stdClass();
    }

    /**
     * Detects when a variable that is used has not been defined before.
     *
     * @return void
     */
    public function undefinedVariable()
    {
        echo $id;
    }
}
