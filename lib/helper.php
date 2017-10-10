<?php
    function contains($text, array $refword)
    {
        foreach($refword as $r)
        {
            if (stripos($text,$r) !== false) return true;
        }
        return false;
    }

    function startwith($text, $refword)
    {
        if (0 === strpos($text, $refword)) 
        {
            return true;
        }
        return false;
    }

    function startwithinarray($text, array $refword)
    {
        foreach($refword as $ref)
        {
            if(startwith($text, $ref))
            {
                return true;
            }
        }
        return false;
    }

    function pickonefromarray(array $ref)
    {
        return $ref[mt_rand(0, count($ref) - 1)];
    }

    function calculate_string($text)
    {
        $mathString = trim($text);
        $mathString = str_replace('[^0-9\+-\*\/\(\) ]', '', $text);
        $compute = create_function("", "return (" . $text . ");" );
        return 0 + $compute();
    }

?>
