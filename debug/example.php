<?php


// loads AutoFill class
require_once "class.autofill.php";



/**
 * starts a new AutoFill object. The parameter
 * must be the "id" attribute of the text field
 * that will display these options
 */
$AF_Beatles = new AutoFill("beatles");

// sets the list of options
$AF_Beatles->addOption("Paul McCartney");
$AF_Beatles->addOption("John Lennon");
$AF_Beatles->addOption("George Harrison");
$AF_Beatles->addOption("Ringo Starr");
$AF_Beatles->addOption("Paul McDonald");
$AF_Beatles->addOption("John Lennox");
$AF_Beatles->addOption("Johnny Walker");
$AF_Beatles->addOption("Ringo Star");
$AF_Beatles->addOption("George Hairy Son");
$AF_Beatles->addOption("Paul Macintosh");
$AF_Beatles->addOption("George Washington");
$AF_Beatles->addOption("Ringo Starman");

// sets the max number of showed options (-1 to no limit)
$AF_Beatles->setLimit(-1);

/**
 * sets if the form should be submited if the user select
 * one auto-fill option from the text box (default: false)
 */
$AF_Beatles->submitOnFill(false);




$AF_Michaels = new AutoFill("michaels");
$AF_Michaels->addOption("Michael Jordan");
$AF_Michaels->addOption("Michael Jackson");
$AF_Michaels->addOption("Michael Schumacher");
$AF_Michaels->addOption("Michael Moore");
$AF_Michaels->addOption("Michael J. Fox");
$AF_Michaels->addOption("Michael Douglas");
$AF_Michaels->addOption("Michael Owen");
$AF_Michaels->addOption("Michael Collins");
$AF_Michaels->addOption("Michael Myers");
$AF_Michaels->addOption("Michael Nielsen");
$AF_Michaels->addOption("Michael Keaton");
$AF_Michaels->addOption("Michael Smith");
$AF_Michaels->addOption("Michael Baker");
$AF_Michaels->setLimit(10);



$AF_Dwarfs = new AutoFill("dwarfs");
$AF_Dwarfs->addOption("Doc");
$AF_Dwarfs->addOption("Happy");
$AF_Dwarfs->addOption("Bashful");
$AF_Dwarfs->addOption("Sneezy");
$AF_Dwarfs->addOption("Sleepy");
$AF_Dwarfs->addOption("Grumpy");
$AF_Dwarfs->addOption("Dopey");
$AF_Dwarfs->submitOnFill();




?><html>
  <head>
    <title>Auto-fill for text fields</title>
<?php

// creates the javascript code between <head> and </head> tags
$AF_Beatles->create();
$AF_Michaels->create();
$AF_Dwarfs->create();

?>
    <style type="text/css">
        body {
            font: 90% Verdana, Arial;
        }
        h1 {
            margin: 0px;
            font: 200% Tahoma, Arial;
        }
        h2 {
            margin: 0px;
            font: 170% Tahoma, Arial;
        }
        hr {
            width: 80%;
            margin: 0px;
            text-align: left;
            color: #aaa;
        }
        .credits {
            font-size: 60%;
            font-weight: normal;
        }


        .autofill-box {
          z-index: 100;
          padding: 1px;
          background: #e5e5e5;
          border: 1px dotted #000;
          text-align: left;
          font: 11px Verdana, Arial, sans-serif;
        }
        .autofill-box li {padding: 2px 7px;}
        .autofill-box .selection {
          background: #AAF;
          color: #FFF;
        }
    </style>
  </head>

  <body>
    <h1>AutoFill <span class="credits">by Carlos Reche</span></h1>
    <hr />

    <p>
      This is a demonstration of AutoFill class, wich allows
      you to easily create cross-browser auto-fill options to text fields. You
      don't have to worry about the Javascript part. Only create the text field
      and give it an specified "id". Then create the PHP part, wich you can
      learn by seeing the source code of this script.
    </p>

    <form action="" method="get" style="margin: 70px 50px;">

      <p>
        The name of a Beatle: <input type="text" name="textField_1" id="beatles" />
        <em>(try one of the fab-four)</em>
      </p>
      <hr />
      <p>
        A Michael that you know: <input type="text" name="textField_2" id="michaels" />
        <em>(this will display a maximum of 10 options)</em>
      </p>
      <hr />
      <p>
        A dwarf: <input type="text" name="textField_3" id="dwarfs" style="height: 50px;" />
        <em>(even if the field has a custom height, the box is displayed where it should be.
        The form will be submited if the user select on option from this field)</em>
      </p>
    </form>

  </body>
</html>
