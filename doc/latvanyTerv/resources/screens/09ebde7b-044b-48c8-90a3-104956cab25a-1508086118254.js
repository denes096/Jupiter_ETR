jQuery("#simulation")
  .on("click", ".s-09ebde7b-044b-48c8-90a3-104956cab25a .click", function(event, data) {
    var jEvent, jFirer, cases;
    if(data === undefined) { data = event; }
    jEvent = jimEvent(event);
    jFirer = jEvent.getEventFirer();
    if(jFirer.is("#s-Button_7")) {
      cases = [
        {
          "blocks": [
            {
              "actions": [
                {
                  "action": "jimShow",
                  "parameter": {
                    "target": [ "#s-Button_6","#s-Button_10","#s-Button_14","#s-Button_11","#s-Button_9","#s-Button_4","#s-Button_13","#s-Button_8","#s-Button_12","#s-Button_3","#s-Button_5","#s-Table_1","#s-Button_2" ]
                  },
                  "exectype": "serial",
                  "delay": 0
                }
              ]
            }
          ],
          "exectype": "serial",
          "delay": 0
        }
      ];
      event.data = data;
      jEvent.launchCases(cases);
    }
  });