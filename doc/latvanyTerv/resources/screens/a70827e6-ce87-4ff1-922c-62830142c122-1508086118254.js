jQuery("#simulation")
  .on("click", ".s-a70827e6-ce87-4ff1-922c-62830142c122 .click", function(event, data) {
    var jEvent, jFirer, cases;
    if(data === undefined) { data = event; }
    jEvent = jimEvent(event);
    jFirer = jEvent.getEventFirer();
    if(jFirer.is("#s-Button_16")) {
      cases = [
        {
          "blocks": [
            {
              "actions": [
                {
                  "action": "jimShow",
                  "parameter": {
                    "target": [ "#s-Button_12","#s-Button_8","#s-Button_4","#s-Button_5","#s-Table_1","#s-Button_14","#s-Button_6","#s-Button_3","#s-Button_2","#s-Button_7","#s-Button_10","#s-Button_13","#s-Button_11","#s-Button_9","#s-Button_15" ]
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