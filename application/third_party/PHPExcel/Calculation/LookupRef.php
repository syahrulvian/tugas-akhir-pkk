an be a single cell or a range of cells. You can specify the number of rows and
     * the number of columns to be returned.
     *
     * Excel Function:
     *        =OFFSET(cellAddress, rows, cols, [height], [width])
     *
     * @param    cellAddress        The reference from which you want to base the offset. Reference must refer to a cell or
     *                                range of adjacent cells; otherwise, OFFSET returns the #VALUE! error value.
     * @param    rows            The number of rows, up or down, that you want the upper-left cell to refer to.
     *                                Using 5 as the rows argument specifies that the upper-left cell in the reference is
     *                                five rows below reference. Rows can be positive (which means below the starting reference)
     *                                or negative (which means above the starting reference).
     * @param    cols            The number of columns, to the left or right, that you want the upper-left cell of the result
     *                                to refer to. Using 5 as the cols argument specifies that the upper-left cell in the
     *                                reference is five columns to the right of reference. Cols can be positive (which means
     *                                to the right of the starting reference) or negative (which means to the left of the
     *                                starting reference).
     * @param    height            The height, in number of rows, that you want the returned reference to be. Height must be a positive number.
     * @param    width            The width, in number of columns, that you want the returned reference to be. Width must be a positive number.
     * @return    string            A reference to a cell or range of cells
     */
    public static function OFFSET($cellAddress = null, $rows = 0, $columns = 0, $height = null, $width = null)
    {
        $rows    = PHPExcel_Calculation_Functions::flattenSingleValue($rows);
        $columns = PHPExcel_Calculation_Functions::flattenSingleValue($columns);
        $height  = PHPExcel_Calculation_Functions::flattenSingleValue($height);
        $width   = PHPExcel_Calculation_Functions::flattenSingleValue($width);
        if ($cellAddress == null) {
            return 0;
        }

        $args = func_get_args();
        $pCell = array_pop($args);
        if (!is_object($pCell)) {
            return PHPExcel_Calculation_Functions::REF();
        }

        $sheetName = null;
        if (strpos($cellAddress, "!")) {
            list($sheetName, $cellAddress) = explode("!", $cellAddress);
            $sheetName = trim($sheetName, "'");
        }
        if (strpos($cellAddress, ":")) {
            list($startCell, $endCell) = explode(":", $cellAddress);
        } else {
            $startCell = $endCell = $cellAddress;
        }
        list($startCellColumn, $startCellRow) = PHPExcel_Cell::coordinateFromString($startCell);
        list($endCellColumn, $endCellRow) = PHPExcel_Cell::coordinateFromString($endCell);

        $startCellRow += $rows;
        $startCellColumn = PHPExcel_Cell::columnIndexFromString($startCellColumn) - 1;
        $startCellColumn += $columns;

        if (($startCellRow <= 0) || ($startCellColumn < 0)) {
            return PHPExcel_Calculation_Functions::REF();
        }
        $endCellColumn = PHPExcel_Cell::columnIndexFromString($endCellColumn) - 1;
        if (($width != null) && (!is_object($width))) {
            $endCellColumn = $startCellColumn + $width - 1;
        } else {
            $endCellColumn += $columns;
        }
        $startCellColumn = PHPExcel_Cell::stringFromColumnIndex($startCellColumn);

        if (($height != null) && (!is_object($height))) {
            $endCellRow = $startCellRow + $height - 1;
        } else {
            $endCellRow += $rows;
        }

        if (($endCellRow <= 0) || ($endCellColumn < 0)) {
            return PHPExcel_Calculation_Functions::REF();
        }
        $endCellColumn = PHPExcel_Cell::stringFromColumnIndex($endCellColumn);

        $cellAddress = $startCellColumn.$startCellRow;
        if (($startCellColumn != $endCellColumn) || ($startCellRow != $endCellRow)) {
            $cellAddress .= ':'.$endCellColumn.$endCellRow;
        }

        if ($sheetName !== null) {
            $pSheet = $pCell->getWorksheet()->getParent()->getSheetByName($sheetName);
        } else {
            $pSheet = $pCell->getWorksheet();
        }

        return PHPExcel_Calculation::getInstance()->extractCellRange($cellAddress, $pSheet, false);
    }


    /**
     * CHOOSE
     *
     * Uses lookup_value to return a value from the list of value arguments.
     * Use CHOOSE to select one of up to 254 values based on the lookup_value.
     *
     * Excel Function:
     *        =CHOOSE(index_num, value1, [value2], ...)
     *
     * @param    index_num        Specifies which value argument is selected.
     *                            Index_num must be a number between 1 and 254, or a formula or reference to a cell containing a number
     *                                between 1 and 254.
     * @param    value1...        Value1 is required, subsequent values are optional.
     *                            Between 1 to 254 value arguments from which CHOOSE selects a value or an action to perform based on
     *                                index_num. The arguments can be numbers, cell references, defined names, formulas, functions, or
     *                                text.
     * @return    mixed            The selected value
     */
    public static function CHOOSE()
    {
        $chooseArgs = func_get_args();
        $chosenEntry = PHPExcel_Calculation_Functions::flattenArray(array_shift($chooseArgs));
        $entryCount = count($chooseArgs) - 1;

        if (is_array($chosenEntry)) {
            $chosenEntry = array_shift($chosenEntry);
        }
        if ((is_numeric($chosenEntry)) && (!is_bool($chosenEntry))) {
            --$chosenEntry;
        } else {
            return PHPExcel_Calculation_Functions::VALUE();
        }
        $chosenEntry = floor($chosenEntry);
        if (($chosenEntry < 0) || ($chosenEntry > $entryCount)) {
            return PHPExcel_Calculation_Functions::VALUE();
        }

        if (is_array($chooseArgs[$chosenEntry])) {
            return PHPExcel_Calculation_Functions::flattenArray($chooseArgs[$chosenEntry]);
        } else {
            return $chooseArgs[$chosenEntry];
        }
    }


    /**
     * MATCH
     *
     * The MATCH function searches for a specified item in a range of cells
     *
     * Excel Function:
     *        =MATCH(lookup_value, lookup_array, [match_type])
     *
     * @param    lookup_value    The value that you want to match in lookup_array
     * @param    lookup_array    The range of cells being searched
     * @param    match_type        The number -1, 0, or 1. -1 means above, 0 means exact match, 1 means below. If match_type is 1 or -1, the list has to be ordered.
     * @return    integer            The relative position of the found item
     */
    public static function MATCH($lookup_value, $lookup_array, $match_type = 1)
    {
        $lookup_array = PHPExcel_Calculation_Functions::flattenArray($lookup_array);
        $lookup_value = PHPExcel_Calculation_Functions::flattenSingleValue($lookup_value);
        $match_type    = (is_null($match_type)) ? 1 : (int) PHPExcel_Calculation_Functions::flattenSingleValue($match_type);
        //    MATCH is not case sensitive
        $lookup_value = strtolower($lookup_value);

        //    lookup_value type has to be number, text, or logical values
        if ((!is_numeric($lookup_value)) && (!is_string($lookup_value)) && (!is_bool($lookup_value))) {
            return PHPExcel_Calculation_Functions::NA();
        }

        //    match_type is 0, 1 or -1
        if (($match_type !== 0) && ($match_type !== -1) && ($match_type !== 1)) {
            return PHPExcel_Calculation_Functions::NA();
        }

        //    lookup_array should not be empty
        $lookupArraySize = count($lookup_array);
        if ($lookupArraySize <= 0) {
            return PHPExcel_Calculation_Functions::NA();
        }

        //    lookup_array should contain only number, text, or logical values, or empty (null) cells
        foreach ($lookup_array as $i => $lookupArrayValue) {
            //    check the type of the value
            if ((!is_numeric($lookupArrayValue)) && (!is_string($lookupArrayValue)) &&
                (!is_bool($lookupArrayValue)) && (!is_null($lookupArrayValue))) {
                return PHPExcel_Calculation_Functions::NA();
            }
            //    convert strings to lowercase for case-insensitive testing
            if (is_string($lookupArrayValue)) {
                $lookup_array[$i] = strtolower($lookupArrayValue);
            }
            if ((is_null($lookupArrayValue)) && (($match_type == 1) || ($match_type == -1))) {
                $lookup_array = array_slice($lookup_array, 0, $i-1);
            }
        }

        // if match_type is 1 or -1, the list has to be ordered
        if ($match_type == 1) {
            asort($lookup_array);
            $keySet = array_keys($lookup_array);
        } elseif ($match_type == -1) {
            arsort($lookup_array);
            $keySet = array_keys($lookup_array);
        }

        // **
        // find the match
        // **
        foreach ($lookup_array as $i => $lookupArrayValue) {
            if (($match_type == 0) && ($lookupArrayValue == $lookup_value)) {
                //    exact match
                return ++$i;
            } elseif (($match_type == -1) && ($lookupArrayValue <= $lookup_value)) {
                $i = array_search($i, $keySet);
                // if match_type is -1 <=> find the smallest value that is greater than or equal to lookup_value
                if ($i < 1) {
                    // 1st cell was already smaller than the lookup_value
                    break;
                } else {
                    // the previous cell was the match
                    return $keySet[$i-1]+1;
                }
            } elseif (($match_type == 1) && ($lookupArrayValue >= $lookup_value)) {
                $i = array_search($i, $keySet);
                // if match_type is 1 <=> find the largest value that is less than or equal to lookup_value
                if ($i < 1) {
                    // 1st cell was already bigger than the lookup_value
                    break;
                } else {
                    // the previous cell was the match
                    return $keySet[$i-1]+1;
                }
            }
        }

        //    unsuccessful in finding a match, return #N/A error value
        return PHPExcel_Calculation_Functions::NA();
    }


    /**
     * INDEX
     *
     * Uses an index to choose a value from a reference or array
     *
     * Excel Function:
     *        =INDEX(range_array, row_num, [column_num])
     *
     * @param    range_array        A range of cells or an array constant
     * @param    row_num            The row in array from which to return a value. If row_num is omitted, column_num is required.
     * @param    column_num        The column in array from which to return a value. If column_num is omitted, row_num is required.
     * @return    mixed            the value of a specified cell or array of cells
     */
    public static function INDEX($arrayValues, $rowNum = 0, $columnNum = 0)
    {
        if (($rowNum < 0) || ($columnNum < 0)) {
            return PHPExcel_Calculation_Functions::VALUE();
        }

        if (!is_array($arrayValues)) {
            return PHPExcel_Calculation_Functions::REF();
        }

        $rowKeys = array_keys($arrayValues);
        $columnKeys = @array_keys($arrayValues[$rowKeys[0]]);

        if ($columnNum > count($columnKeys)) {
            return PHPExcel_Calculation_Functions::VALUE();
        } elseif ($columnNum == 0) {
            if ($rowNum == 0) {
                return $arrayValues;
            }
            $rowNum = $rowKeys[--$rowNum];
            $returnArray = array();
            foreach ($arrayValues as $arrayColumn) {
                if (is_array($arrayColumn)) {
                    if (isset($arrayColumn[$rowNum])) {
                        $returnArray[] = $arrayColumn[$rowNum];
                    } else {
                        return $arrayValues[$rowNum];
                    }
                } else {
                    return $arrayValues[$rowNum];
                }
            }
            return $returnArray;
        }
        $columnNum = $columnKeys[--$columnNum];
        if ($rowNum > count($rowKeys)) {
            return PHPExcel_Calculation_Functions::VALUE();
        } elseif ($rowNum == 0) {
            return $arrayValues[$columnNum];
        }
        $rowNum = $rowKeys[--$rowNum];

        return $arrayValues[$rowNum][$columnNum];
    }


    /**
     * TRANSPOSE
     *
     * @param    array    $matrixData    A matrix of values
     * @return    array
     *
     * Unlike the Excel TRANSPOSE function, which will only work on a single row or column, this function will transpose a full matrix.
     */
    public static function TRANSPOSE($matrixData)
    {
        $returnMatrix = array();
        if (!is_array($matrixData)) {
            $matrixData = array(array($matrixData));
        }

        $column = 0;
        foreach ($matrixData as $matrixRow) {
            $row = 0;
            foreach ($matrixRow as $matrixCell) {
                $returnMatrix[$row][$column] = $matrixCell;
                ++$row;
            }
            ++$column;
        }
        return $returnMatrix;
    }


    private static function vlookupSort($a, $b)
    {
        reset($a);
        $firstColumn = key($a);
        if (($aLower = strtolower($a[$firstColumn])) == ($bLower = strtolower($b[$firstColumn]))) {
            return 0;
        }
        return ($aLower < $bLower) ? -1 : 1;
    }


    /**
     * VLOOKUP
     * The VLOOKUP function searches for value in the left-most column of lookup_array and returns the value in the same row based on the index_number.
     * @param    lookup_value    The value that you want to match in lookup_array
     * @param    lookup_array    The range of cells being searched
     * @param    index_number    The column number in table_array from which the matching value must be returned. The first column is 1.
     * @param    not_exact_match    Determines if you are looking for an exact match based on lookup_value.
     * @return    mixed            The value of the found cell
     */
    public static function VLOOKUP($lookup_value, $lookup_array, $index_number, $not_exact_match = true)
    {
        $lookup_value    = PHPExcel_Calculation_Functions::flattenSingleValue($lookup_value);
        $index_number    = PHPExcel_Calculation_Functions::flattenSingleValue($index_number);
        $not_exact_match = PHPExcel_Calculation_Functions::flattenSingleValue($not_exact_match);

        // index_number must be greater than or equal to 1
        if ($index_number < 1) {
            return PHPExcel_Calculation_Functions::VALUE();
        }

        // index_number must be less than or equal to the number of columns in lookup_array
        if ((!is_array($lookup_array)) || (empty($lookup_array))) {
            return PHPExcel_Calculation_Functions::REF();
        } else {
            $f = array_keys($lookup_array);
            $firstRow = array_pop($f);
            if ((!is_array($lookup_array[$firstRow])) || ($index_number > count($lookup_array[$firstRow]))) {
                return PHPExcel_Calculation_Functions::REF();
            } else {
                $columnKeys = array_keys($lookup_array[$firstRow]);
                $returnColumn = $columnKeys[--$index_number];
                $firstColumn = array_shift($columnKeys);
            }
        }

        if (!$not_exact_match) {
            uasort($lookup_array, array('self', 'vlookupSort'));
        }

        $rowNumber = $rowValue = false;
        foreach ($lookup_array as $rowKey => $rowData) {
            if ((is_numeric($lookup_value) && is_numeric($rowData[$firstColumn]) && ($rowData[$firstColumn] > $lookup_value)) ||
                (!is_numeric($lookup_value) && !is_numeric($rowData[$firstColumn]) && (strtolower($rowData[$firstColumn]) > strtolower($lookup_value)))) {
                break;
            }
            $rowNumber = $rowKey;
            $rowValue = $rowData[$firstColumn];
        }

        if ($rowNumber !== false) {
            if ((!$not_exact_match) && ($rowValue != $lookup_value)) {
                //    if an exact match is required, we have what we need to return an appropriate response
                return PHPExcel_Calculation_Functions::NA();
            } else {
                //    otherwise return the appropriate value
                return $lookup_array[$rowNumber][$returnColumn];
            }
        }

        return PHPExcel_Calculation_Functions::NA();
    }


    /**
     * HLOOKUP
     * The HLOOKUP function searches for value in the top-most row of lookup_array and returns the value in the same column based on the index_number.
     * @param    lookup_value    The value that you want to match in lookup_array
     * @param    lookup_array    The range of cells being searched
     * @param    index_number    The row number in table_array from which the matching value must be returned. The first row is 1.
     * @param    not_exact_match Determines if you are looking for an exact match based on lookup_value.
     * @return   mixed           The value of the found cell
     */
    public static function HLOOKUP($lookup_value, $lookup_array, $index_number, $not_exact_match = true)
    {
        $lookup_value   = PHPExcel_Calculation_Functions::flattenSingleValue($lookup_value);
        $index_number   = PHPExcel_Calculation_Functions::flattenSingleValue($index_number);
        $not_exact_match    = PHPExcel_Calculation_Functions::flattenSingleValue($not_exact_match);

        // index_number must be greater than or equal to 1
        if ($index_number < 1) {
            return PHPExcel_Calculation_Functions::VALUE();
        }

        // index_number must be less than or equal to the number of columns in lookup_array
        if ((!is_array($lookup_array)) || (empty($lookup_array))) {
            return PHPExcel_Calculation_Functions::REF();
        } else {
            $f = array_keys($lookup_array);
            $firstRow = array_pop($f);
            if ((!is_array($lookup_array[$firstRow])) || ($index_number > count($lookup_array[$firstRow]))) {
                return PHPExcel_Calculation_Functions::REF();
            } else {
                $columnKeys = array_keys($lookup_array[$firstRow]);
                                $firstkey = $f[0] - 1;
                $returnColumn = $firstkey + $index_number;
                $firstColumn = array_shift($f);
            }
        }

        if (!$not_exact_match) {
            $firstRowH = asort($lookup_array[$firstColumn]);
        }

        $rowNumber = $rowValue = false;
        foreach ($lookup_array[$firstColumn] as $rowKey => $rowData) {
            if ((is_numeric($lookup_value) && is_numeric($rowData) && ($rowData > $lookup_value)) ||
                (!is_numeric($lookup_value) && !is_numeric($rowData) && (strtolower($rowData) > strtolower($lookup_value)))) {
                break;
            }
            $rowNumber = $rowKey;
            $rowValue = $rowData;
        }

        if ($rowNumber !== false) {
            if ((!$not_exact_match) && ($rowValue != $lookup_value)) {
                //  if an exact match is required, we have what we need to return an appropriate response
                return PHPExcel_Calculation_Functions::NA();
            } else {
                //  otherwise return the appropriate value
                return $lookup_array[$returnColumn][$rowNumber];
            }
        }

        return PHPExcel_Calculation_Functions::NA();
    }


    /**
     * LOOKUP
     * The LOOKUP function searches for value either from a one-row or one-column range or from an array.
     * @param    lookup_value    The value that you want to match in lookup_array
     * @param    lookup_vector    The range of cells being searched
     * @param    result_vector    The column from which the matching value must be returned
     * @return    mixed            The value of the found cell
     */
    public static function LOOKUP($lookup_value, $lookup_vector, $result_vector = null)
    {
        $lookup_value = PHPExcel_Calculation_Functions::flattenSingleValue($lookup_value);

        if (!is_array($lookup_vector)) {
            return PHPExcel_Calculation_Functions::NA();
        }
        $lookupRows = count($lookup_vector);
        $l = array_keys($lookup_vector);
        $l = array_shift($l);
        $lookupColumns = count($lookup_vector[$l]);
        if ((($lookupRows == 1) && ($lookupColumns > 1)) || (($lookupRows == 2) && ($lookupColumns != 2))) {
            $lookup_vector = self::TRANSPOSE($lookup_vector);
            $lookupRows = count($lookup_vector);
            $l = array_keys($lookup_vector);
            $lookupColumns = count($lookup_vector[array_shift($l)]);
        }

        if (is_null($result_vector)) {
            $result_vector = $lookup_vector;
        }
        $resultRows = count($result_vector);
        $l = array_keys($result_vector);
        $l = array_shift($l);
        $resultColumns = count($result_vector[$l]);
        if ((($resultRows == 1) && ($resultColumns > 1)) || (($resultRows == 2) && ($resultColumns != 2))) {
            $result_vector = self::TRANSPOSE($result_vector);
            $resultRows = count($result_vector);
            $r = array_keys($result_vector);
            $resultColumns = count($result_vector[array_shift($r)]);
        }

        if ($lookupRows == 2) {
            $result_vector = array_pop($lookup_vector);
            $lookup_vector = array_shift($lookup_vector);
        }
        if ($lookupColumns != 2) {
            foreach ($lookup_vector as &$value) {
                if (is_array($value)) {
                    $k = array_keys($value);
                    $key1 = $key2 = array_shift($k);
                    $key2++;
                    $dataValue1 = $value[$key1];
                } else {
                    $key1 = 0;
                    $key2 = 1;
                    $dataValue1 = $value;
                }
                $dataValue2 = array_shift($result_vector);
                if (is_array($dataValue2)) {
                    $dataValue2 = array_shift($dataValue2);
                }
                $value = array($key1 => $dataValue1, $key2 => $dataValue2);
            }
            unset($value);
        }

        return self::VLOOKUP($lookup_value, $lookup_vector, 2);
    }
}
