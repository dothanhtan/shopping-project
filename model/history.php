<?php 
class History {
    #region properties
    var $fromYear;
    var $toYear;
    var $class;
    var $place;
    #endregion

    #region construct_function
    function __construct($fromYear, $toYear, $class, $place) {
        $this->fromYear = $fromYear;
        $this->toYear = $toYear;
        $this->class = $class;
        $this->place = $place;
    }
    #endregion


    #region mock_data
    /**
     * Get all history learning in database
     */
    static function getList() {
        $listHistories = array();
        array_push($listHistories, new History(2004, 2009,"1A - 5A", "Tieu hoc so 2 Tu Ha"));
        array_push($listHistories, new History(2009, 2013,"6A - 9A", "THCS Ha The Hanh"));
        array_push($listHistories, new History(2013, 2016,"10A1 - 12A1", "THPT Dang Huy Tru"));
        array_push($listHistories, new History(2016, 2020,"CNTT/K40D", "Dai hoc Khoa hoc - Dai hoc Hue"));

        return $listHistories;
    }
    #endregion
}

?>