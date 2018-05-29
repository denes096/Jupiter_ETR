<html>

<head>
  <?php include_once("php/htmlhead.php"); ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <?php
      include_once("php/header.php");
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");
      include_once("handle_post_requests.php");
    ?>

    <div class="container">
      <div class="header"></div>
      <div class="body">

        <div class="titleParent">
          <h2>Statisztikák
            <?php 
              if($_SESSION['jog'] == 1) {
                 echo "(Oktatott kurzusokon)";
              }
      ?>
          </h2>
        

        <form name="szak-semester-form" id="szak-semester-form" action="" method="post">
          <?php
        echo 'Szak:';
        include('php/elements/form-szak.php');
        echo 'Félév:';
        include('php/elements/form-semester.php');
        //echo $szak;
		echo '<a href="statisztika.php">Szövegesen</a>';

        if(!isset($_SESSION['jog'])) {
          $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
          header("location: Login.php");
          exit;
        }
      ?>
        </form>
        </div>

        <table id="chartTable" class="full-width query-table">
		
          <!-- TEMPLATE:
      <tr class="stat_row">
			<td class="stat_col"><div id="testDiv" class="stat_div">...</div></td>
			<td class="stat_col">...</td>
	  	</tr> -->
        </table>

        <script type="text/javascript">
          var _temp_semester = "<?php echo $semester; ?>";

          var charts = [];

          google.charts.load('current', {
            'packages': [
              'corechart'
            ],
            'language': 'hu'
          });
          google.charts.setOnLoadCallback(startDrawCall);

          function startDrawCall() {
            // Lekérjük az adatokat
            $.post('php/stats.php', {
              semester: _temp_semester
            }, drawCharts, 'json');

            _temp_semester = undefined;
          }

          function drawCharts(data, textStatus, jqXHR) {
            for (var _chartIndex in data) {
              var _chartData = data[_chartIndex];
              var _dataTable = new google.visualization.DataTable();

              var cols = Object.keys(_chartData.data[0]);
              var cols_removed = [];
              var coltypes = {};

              // Oszlop adattípusok felderítése
              for (var _index in _chartData.data) {
                if (cols_removed.length >= cols.length) {
                  break;
                }

                cols.forEach(function (_col) {
                  // Ha már felvettük ezt az oszlopot, hagyjuk ki
                  if (cols_removed.indexOf(_col) != -1) {
                    return;
                  }

                  // Jelenlegi érték, amit vizsgálunk:
                  var comparingValue = _chartData.data[_index][_col];

                  // Nézzük meg, hogy egyáltalán érvényes-e, ha igen, jegyezzük fel a típusát
                  // és az oszlopát jelöljük meg már látogatottként
                  if (comparingValue != null) {
                    coltypes[_col] = typeof comparingValue;

                    // Nézzük meg, hogy valójában szám-e
                    if (!isNaN(Number(comparingValue))) {
                      coltypes[_col] = "number";
                    }

                    // Jelöljük meg már látogatottként az oszlopot
                    cols_removed.push(_col);
                  }
                });
              }

              // Oszlopok hozzáadása
              for (var ct in coltypes) {
                _dataTable.addColumn(coltypes[ct], ct);
              }

              // Sorok hozzáadása
              for (var _index in _chartData.data) {
                var _item = []; // jelenlegi sort reprezentálja
                var _skip = false; // jelölő, hogy kihagyjuk-e a jelenlegi sort
                for (var ct in coltypes) {
                  var _value = _chartData.data[_index][ct];

                  // Ha be volt állítva, hogy a null értékeket eldobjuk, akkor
                  // itt megjelöljük őket és nem adjuk majd hozzá a táblázathoz
                  if (_chartData.deleteNull == true) {
                    if (_chartData.data[_index][ct] == null) {
                      _skip = true;
                      break;
                    }
                  }

                  // Ellenőrizzük, hogy számmá kell-e alakítani az értéket
                  if (coltypes[ct] == "number") {
                    _item.push(Number(_value));
                  } else {
                    _item.push(_value);
                  }
                }

                // Ha megjelöltünk egy elemet, akkor eldobjuk
                if (!_skip) {
                  _dataTable.addRows([_item]);
                }
              }

              // Készítsük el a következő cellát
              var _tableContainer = addNewRow('stat-' + _chartIndex, _chartIndex % 2)[0];

              // Ellenőrizzük, hogy egyáltalán volt-e nem-null érték
              if (_dataTable.ng.length < 2) {
                // Nincs adat a táblázatban -> nem rajzolunk gráfot, helyette "hiba"-üzenet
                _tableContainer.innerHTML = '<div class="stat-empty-msg-div"><h4>' + _chartData.graphOptions.title +
                  '</h4><p class="stat-empty">Nincs adat ebben a félévben vagy ezen a képzésen.</p></div>';
                $(_tableContainer).addClass("stat-empty-div");
                resizeCharts();
                continue;
              }

              // Alapértelmezett rajzolási beállítások
              var _tableOptions = {
                width: '85%',
                height: '85%',
                hAxis: {
                  title: _dataTable.ng[0].label
                },
                vAxis: {
                  title: _dataTable.ng[1].label
                },
                title: null
              };

              // További beállítások átadása a graphOptions mezőből
              for (var optionIndex in _chartData.graphOptions) {
                _tableOptions[optionIndex] = _chartData.graphOptions[optionIndex];
              }

              // Rajzolás
              var chart = new google.visualization[_chartData.type](_tableContainer);
              chart.draw(_dataTable, _tableOptions);

              // Eltároljuk az ábrát, hogy később átméretezhessük
              charts[_chartIndex] = {
                chart: chart,
                data: _dataTable,
                options: _tableOptions
              }

              resizeCharts();
            }
          }

          // Létrehoz egy új oszlopot a táblázatban (a parity ahhoz kell, 
          // hogy új sort kell-e létrehozni, vagy csak újabb oszlopot kell hozzáadni)
          function addNewRow(divId, parity) {
            var newColumn = $("<td />", {
              class: "stat_col"
            });
            var newDiv = $('<div />', {
              id: divId,
              class: "stat_div"
            });
            newColumn.append(newDiv);

            if (!parity) {
              // Új sort hozunk létre
              var newRow = $('<tr />', {
                class: "stat_row"
              });
              newRow.append(newColumn);
              $('#chartTable').append(newRow);
            } else {
              // Csak hozzáadjuk az új oszlopot a táblázathoz
              $('#chartTable').find("tr").last().append(newColumn);
            }

            // Visszaadjuk az új <div> jQuery objektumát
            return newDiv;
          }

          $(window).resize(function () {
            if (this.resizeTO) clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function () {
              $(this).trigger('resizeEnd');
            }, 500);
          });

          $(window).on('resizeEnd', resizeCharts);

          function resizeCharts() {
            charts.forEach(function (chartObject) {
              chartObject.chart.draw(chartObject.data, chartObject.options);
            });
          }
        </script>
      </div>
      <div class="footer">
        <?php
          include_once("php/footer.php");
        ?>
      </div>
</body>

</html>