(function($) {
  $(document).ready(function() {
    var taskAPI = "tasks.php";
    $('#task-grid').shieldGrid({
      dataSource: {
        events: {
          error: function (event) {
            if (event.errorType == "transport") {
              console.log(event);
              console.log("Transport Error: " + event.error.statusText);
              if (event.operation == "save") {
                this.read();
              }
            }
            else {
              console.log(event.errorType + " Error: " + event.error);
            }
          }
        },
        remote: {
          read: {
            type: "GET",
            url: taskAPI,
            dataType: "json"
          },
          modify: {
            create: function (items, success, error) {
              console.log('Create item');
              var newItem = items[0];
              $.ajax({
                type: 'POST',
                url: taskAPI,
                dataType: "json",
                data: {
                  action: 'create',
                  data: newItem.data
                },
                complete: function (xhr) {
                  if (xhr.readyState == 4) {
                    if (xhr.status == 201) {
                      var taskID = xhr.getResponseHeader('TaskID');
                      newItem.data.id = taskID;
                      success();
                      return;
                    }
                  }
                  error (xhr);
                }
              });
            },
            update: function (items, success, error) {
              $.ajax({
                type: 'POST',
                url: taskAPI,
                dataType: 'json',
                data: {
                  action: 'update',
                  data: items[0].data
                }
              }).then(success, error);
            },
            remove: function (items, success, error) {
              $.ajax({
                type: 'POST',
                url: taskAPI,
                dataType: 'json',
                data: {
                  action: 'delete',
                  data: items[0].data
                }
              });
            }
          }
        },
        schema: {
          fields: {
            id: { path: "id", type: Number },
            name: { path: "name", type: String },
            start_date: { path: "start_date", type: Date },
            end_date: { path: "end_date", type: Date },
            task_type: { path: "task_type", type: Boolean },         
            repeat: { path: "repeat", type: Boolean },
            objects: { path: "objects", type: String }
          }
        }
      },
      sorting: true,
      rowHover: false,
      columns: [
        { field: "name", title: "Name" },
        { 
          field: "start_date",
          title: "Start Date", 
          columnTemplate: function (cell, item) {
            $('<input />')
              .appendTo(cell)
              .shieldDateTimePicker({
                showButton: true,
                value: item["start_date"]
              });
          }
        },
                { 
          field: "end_date",
          title: "End Date", 
          columnTemplate: function (cell, item) {
            $('<input />')
              .appendTo(cell)
              .shieldDateTimePicker({
                showButton: true,
                value: item["end_date"]
              });
          }
        },
        { field: "task_type", title: "Task Type" },
        { field: "repeat", title: "Repeat Weekly" },
        {
          field: "objects",
          title: "Objects",
          columnTemplate: function (cell, item) {
            $('<select />')
              .appendTo(cell)
              .shieldDropDown({
                dataSource: {
                  remote: {
                    read: "objects.json"
                  },
                  schema: {
                    data: "objects"
                  },
                },
                textTemplate: "{name}",
                valueTemplate: "{rfid}",
                value: item["objects"]
              });
          }
        },
        {
          title: "Actions",
          width: "140px",
          buttons: [
            { commandName: "edit", caption: "Edit" },
            { commandName: "delete", caption: "Delete" }
          ]
        }
      ],
      editing: {
        enabled: true,
        type: "row",
      },
      toolbar: [
        {
          buttons: [
            { commandName: "insert", caption: "Add Task" }
          ],
          position: "top"
        }
      ]
    });
  });
})(jQuery);
