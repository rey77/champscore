
<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#persInfo" data-toggle="tab" aria-controls="compInfo" role="tab" title="Competition">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-home"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#boxInfo" data-toggle="tab" aria-controls="wodInfo" role="tab" title="WOD">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#compInfo" data-toggle="tab" aria-controls="summary" role="tab" title="Summary" id="tabWod">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-search"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form role="form" action="CompWizard/inputDB.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="persInfo">
                            <div class="persInfo">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Competition Name</label>
                                        <input type="text" class="form-control" name="compName" placeholder="Competition Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Registration Code for athletes</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="compregCode" placeholder="Registration Code for athletes">
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-md-6">
                                        <label>Competition Date</label>
                                        <input type="date" class="form-control" name="compDate">

                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-md-6">
                                        <label for="fileToUpload">Competition Logo</label>
                                        <input type="file" name="compLogo" id="compLogo"><br>
                                        <input type="submit" class="btn btn-custom-red btn-lg" value="Upload Image" name="submit">
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-custom-red btn-lg next-step">Next</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="boxInfo">
                            <div class="boxInfo">






                                <script>
                                    $(document).ready(function () {

                                        $("#nextWod").click(function () {

                                            var sel_valueDiv = $('#selectDiv option:selected').val();

                                            for (var i = 1; i <= sel_valueDiv; i++) {

                                                $("#Div" + i).empty();
                                                var sel_valueEv = $('#selectEvent' + i + ' option:selected').val();
                                                (function (i) {

                                                    var $this1 = $("#nameDiv_" + i);
                                                    $("#Div" + i).append($("<h1/>"

                                                            ).text($this1.val() + " (Division " + i + ")"));


                                                    for (var a = 1; a <= sel_valueEv; a++) {
                                                        //$("#eventa" +a+ i).remove();
                                                        (function (a) {
                                                            var $this = $("#event_" + a + i).val();

                                                            $("#Div" + i).append($("<div/>", {
                                                                id: 'DivEv' + a + i
                                                            }));
                                                            $("#DivEv" + a + i).append($("<h2/>"

                                                                    ).text($this + " (Event " + a + ")")




                                                                    );

                                                            var sel_valueWod = $('#selectWod' + a + i + ' option:selected').val();

                                                            for (var c = 1; c <= sel_valueWod; c++) {
                                                                //$("#eventa" +a+ i).remove();
                                                                (function (c) {
                                                                    var $this = $("#inputWod" + a + i + c).val();
                                                                    var $this1 = $("#textWod" + a + i + c).val();

                                                                    $("#DivEv" + a + i).append($("<div/>", {
                                                                        id: 'DivWod' + a + i + c
                                                                    }));
                                                                    $("#DivWod" + a + i + c).append($("<h3/>"

                                                                            ).text($this + " (WOD Name " + c + ")"),
                                                                            $("<p/>").text($this1 + " (WOD Description " + c + ")")

                                                                            );


                                                                })(c);
                                                            }


                                                        })(a);
                                                    }

                                                })(i);

                                            }



                                        });

                                        $("#tabWod").click(function () {
                                            var sel_valueDiv = $('#selectDiv option:selected').val();

                                            for (var i = 1; i <= sel_valueDiv; i++) {

                                                $("#Div" + i).empty();
                                                var sel_valueEv = $('#selectEvent' + i + ' option:selected').val();
                                                (function (i) {

                                                    var $this1 = $("#nameDiv_" + i);
                                                    $("#Div" + i).append($("<h1/>"

                                                            ).text($this1.val() + " (Division " + i + ")"));


                                                    for (var a = 1; a <= sel_valueEv; a++) {
                                                        //$("#eventa" +a+ i).remove();
                                                        (function (a) {
                                                            var $this = $("#event_" + a + i).val();

                                                            $("#Div" + i).append($("<div/>", {
                                                                id: 'DivEv' + a + i
                                                            }));
                                                            $("#DivEv" + a + i).append($("<h2/>"

                                                                    ).text($this + " (Event " + a + ")")




                                                                    );

                                                            var sel_valueWod = $('#selectWod' + a + i + ' option:selected').val();

                                                            for (var c = 1; c <= sel_valueWod; c++) {
                                                                //$("#eventa" +a+ i).remove();
                                                                (function (c) {
                                                                    var $this = $("#inputWod" + a + i + c).val();
                                                                    var $this1 = $("#textWod" + a + i + c).val();

                                                                    $("#DivEv" + a + i).append($("<div/>", {
                                                                        id: 'DivWod' + a + i + c
                                                                    }));
                                                                    $("#DivWod" + a + i + c).append($("<h3/>"

                                                                            ).text($this + " (WOD Name " + c + ")"),
                                                                            $("<p/>").text($this1 + " (WOD Description " + c + ")")

                                                                            );


                                                                })(c);
                                                            }


                                                        })(a);
                                                    }

                                                })(i);

                                            }



                                        });


                                        //DIFINE DIVISION
                                        $('#selectDiv').change(function () {
                                            var sel_value = $('#selectDiv option:selected').val();
                                            if (sel_value == 0) {


                                                $("#divDivison1").empty(); // Resetting Form
                                                $("#divDivison2").empty(); // Resetting Form
                                                $("#divDivison3").empty(); // Resetting Form
                                                $("#divDivison4").empty(); // Resetting Form
                                                $("#divDivison1").removeAttr("style");
                                                $("#divDivison2").removeAttr("style");
                                                $("#divDivison3").removeAttr("style");
                                                $("#divDivison4").removeAttr("style");

                                            } else {

                                                $("#divDivison1").empty(); // Resetting Form
                                                $("#divDivison2").empty(); // Resetting Form
                                                $("#divDivison3").empty(); // Resetting Form
                                                $("#divDivison4").empty(); // Resetting Form
                                                $("#divDivison1").removeAttr("style");
                                                $("#divDivison2").removeAttr("style");
                                                $("#divDivison3").removeAttr("style");
                                                $("#divDivison4").removeAttr("style");


                                                create(sel_value);
                                            }
                                        });
                                        function create(sel_value) {
                                            for (var i = 1; i <= sel_value; i++) {
                                                (function (i) {
                                                    
                                                    document.getElementById('divDivison' + i).setAttribute('style', 'border:5px solid #8B0000; ');
                                                    document.getElementById('Div' + i).setAttribute('style', 'border:0.5px solid grey; ');
                                                    $("#divDivison" + i).append(
                                                            $("<h1/>").text("Division " + i), $("<input/>", {
                                                        class: 'form-control',
                                                        type: 'text',
                                                        id: "nameDiv_" + i,
                                                        name: 'nameDiv_' + i
                                                        
                                                    }),
                                                            $("<label/>").text("Number of Events"),
                                                            $("<select/>", {
                                                                class: 'form-control',
                                                                id: 'selectEvent' + i,
                                                                name: 'selEvent' + i

                                                            }),
                                                            $("<div/>", {

                                                                id: 'divEvent' + i}),
                                                            $("<br/>"), $("<br/>")
                                                            );



                                                    $("#selectEvent" + i).append($("<option/>", {
                                                        text: '0',
                                                        value: '0'
                                                    }),
                                                            $("<option/>", {
                                                                text: '1',
                                                                value: '1'
                                                            }),
                                                            $("<option/>", {
                                                                text: '2',
                                                                value: '2'
                                                            }),
                                                            $("<option/>", {
                                                                text: '3',
                                                                value: '3'
                                                            }),
                                                            $("<option/>", {
                                                                text: '4',
                                                                value: '4'
                                                            })


                                                            );
                                                })(i);
                                            }

                                        }




                                        $('#selectDiv').change(function () {
                                            var sel_value = $('#selectDiv option:selected').val();
                                            for (var i = 1; i <= sel_value; i++) {



                                                (function (i) {


                                                    $('#numbDiv').on('change', '#selectEvent' + i, function () {

                                                        var sel_value1 = $('#selectEvent' + i + ' option:selected').val();
                                                        if (sel_value1 == 0) {
                                                            $("#divEvent" + i).empty(); // Resetting Form

                                                        } else {

                                                            $("#divEvent" + i).empty(); //Resetting Form

                                                            create1(sel_value1);
                                                        }

                                                        function create1(sel_value1) {

                                                            for (var a = 1; a <= sel_value1; a++) {


                                                                (function (a) {

                                                                    $("#divEvent" + i).append($("<h2/>").text("Event " + a),
                                                                            $("<input/>", {
                                                                                class: 'form-control',
                                                                                type: 'text',
                                                                                id: "event_" + a + i,
                                                                                name: 'event_' + a + i
                                                                            }));

                                                                    $("#divEvent" + i).append($("<div/>", {
                                                                        id: 'DivE' + a + i
                                                                    }));
                                                                    $("#DivE" + a + i).append(
                                                                            $("<label/>").text("Number of Wods"),
                                                                            $("<select/>", {
                                                                                class: 'form-control',
                                                                                id: 'selectWod' + a + i,
                                                                                name: 'selWod' + a + i



                                                                            }), $('<br/>'));
                                                                    $("#selectWod" + a + i).append($("<option/>", {
                                                                        text: '0',
                                                                        value: '0'
                                                                    }),
                                                                            $("<option/>", {
                                                                                text: '1',
                                                                                value: '1'
                                                                            }),
                                                                            $("<option/>", {
                                                                                text: '2',
                                                                                value: '2'
                                                                            }),
                                                                            $("<option/>", {
                                                                                text: '3',
                                                                                value: '3'
                                                                            }),
                                                                            $("<option/>", {
                                                                                text: '4',
                                                                                value: '4'
                                                                            })


                                                                            );

                                                                })(a);
                                                            }
                                                        }

                                                    });
                                                })(i);
                                            }

                                        });
                                        $('#selectDiv').change(function () {
                                            var sel_value = $('#selectDiv option:selected').val();
                                            for (var i = 1; i <= sel_value; i++) {



                                                (function (i) {


                                                    $('#numbDiv').on('change', '#selectEvent' + i, function () {

                                                        var sel_value1 = $('#selectEvent' + i + ' option:selected').val();
                                                        for (var a = 1; a <= sel_value1; a++) {

                                                            (function (a) {
                                                                $('#numbDiv').on('change', '#selectWod' + a + i, function () {


                                                                    var sel_value2 = $('#selectWod' + a + i + ' option:selected').val();

                                                                    if (sel_value2 == 0) {

                                                                        $('#divWod' + a + i + "1").empty();
                                                                        $('#divWod' + a + i + "2").empty();
                                                                        $('#divWod' + a + i + "3").empty();
                                                                        $('#divWod' + a + i + "4").empty();


                                                                    } else {

                                                                        $('#divWod' + a + i + "1").empty();
                                                                        $('#divWod' + a + i + "2").empty();
                                                                        $('#divWod' + a + i + "3").empty();
                                                                        $('#divWod' + a + i + "4").empty();

                                                                        create2(sel_value2);

                                                                    }
                                                                    function create2(sel_value2) {

                                                                        for (var c = 1; c <= sel_value2; c++) {


                                                                            (function (c) {
                                                                                $("#DivE" + a + i).append($("<div/>", {
                                                                                    id: 'divWod' + a + i + c
                                                                                }));

                                                                                $("#divWod" + a + i + c).append($("<label/>").text("Name Wod " + c),
                                                                                        $("<br/>"),
                                                                                        $("<input/>", {
                                                                                            class: 'form-control',
                                                                                            type: 'text',
                                                                                            id: 'inputWod' + a + i + c,
                                                                                            name: 'inputWod' + a + i + c
                                                                                        }
                                                                                        ), $("<label/>").text("Description of Wod" + 1),
                                                                                        $("<textarea/>", {
                                                                                            class: 'form-control',
                                                                                            id: 'textWod' + a + i + c,
                                                                                            name: 'textWod' + a + i + c
                                                                                        }),
                                                                                        $("<br/>")

                                                                                        );


                                                                            })(c);
                                                                        }
                                                                    }




                                                                });
                                                            })(a);
                                                        }


                                                    });
                                                })(i);
                                            }

                                        });
                                    });
                                </script>

                                <script>










                                </script>

                                <div class="col-md-12">
                                    <label for="exampleSelect1">Number of Divisions</label>
                                    <select class="form-control" id="selectDiv" name="selectDiv" >
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                    <br/>
                                </div>

                                <div  id="numbDiv" >
                                    <div class="row">

                                        <div class="col-md-6" id="divDivison1" > 


                                        </div>
                                        <div class="col-md-6" id="divDivison2"  >

                                        </div>
                                    </div> 

                                    <div class="row">

                                        <div class="col-md-6" id="divDivison3"  >

                                        </div>
                                        <div class="col-md-6" id="divDivison4"  >

                                        </div>
                                    </div> 



                                </div>
                                <br/>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <ul class="list-inline pull-right">

                                <li><button type="button" class="btn btn-custom-red btn-lg prev-step">Back</button></li>
                                <li><button type="button" class="btn btn-custom-red btn-lg next-step" id="nextWod">Next</button></li>
                            </ul>
                        </div>



                        <div class="tab-pane" role="tabpanel" id="compInfo">
                            <div class="compInfo">

                                <div id="divmaster">
                                    <div class="row">

                                        <div class="col-md-6" id="Div1" >

                                        </div>
                                        <div class="col-md-6" id="Div2" >

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" id="Div3" >


                                        </div>
                                        <div class="col-md-6" id="Div4" > 

                                        </div>
                                    </div>
                                </div>




                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-custom-red btn-lg prev-step">Back</button></li>
                                <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                <li><button type="button" class="btn btn-custom-red btn-lg btn-info-full next-step">Next</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="complete">
                            <div class="step44">
                                <h5>Completed</h5>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-custom-red btn-lg prev-step">Back</button></li>
                                    <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->

                                    <li> <button type="submit" name="submit" class="btn btn-custom-red btn-lg btn-info-full next-step">Save</button></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript" src="js/wizard.js"></script>
