/*
 Call to controller action to add task
 */
$('#submit').click(function(){
    var dueDate = $('#dueDate').val();
    var title = $('#title').val();
    var priority = $('#priority').val();
    var content = $('#content').val();
    var assigned = $('#assigned').val();

    $.get(Routing.generate('add', {dueDate : dueDate, title : title, priority : priority, content : content, assigned : assigned}),//send values to action
        function(response) {//waiting ajaxResponse from action
            if (response == 1) {
                alert('Task has been successfully created');
                window.location.reload();
            }
        });
});

/*
 Current and future date only
 */

$(document).ready(function(){
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("dueDate")[0].setAttribute('min', today); //disables past date
    document.getElementsByName("dueDate")[0].setAttribute('value', today); //sets auto today's day
});

/*
 Task editing
 */
$('.edit_task').click(function(){
    var task_id = $(this).data('id');

    $('.task_block').find("[data-id= " + task_id + "]").prop('disabled', false);
    $('.task_assigned_to').find("[data-id= " + task_id + "]").removeClass('disabled').css('border-bottom','2px solid #3498db');
    $('.due_date').find("[data-id= " + task_id + "]").removeClass('disabled').css('border-bottom','2px solid #3498db');
    $('.task_title').find("[data-id= " + task_id + "]").removeClass('disabled').css('border-bottom','2px solid #3498db');
    $('.task_content').find("[data-id= " + task_id + "]").removeClass('disabled').css('border-bottom','2px solid #3498db');
    $('.complete_label').find("[data-id= " + task_id + "]").removeClass('hidden');
    $('.save_task_button').find("[data-id= " + task_id + "]").removeClass('save_hidden');
    $('.cancel_task_button').find("[data-id= " + task_id + "]").removeClass('cancel');
    $('.edit_task_button').find("[data-id= " + task_id + "]").hide();
});

/*
 Task edit save
 */
$('.save').click(function(){
    var task_id = $(this).data('id');
    var edit_assigned = $('.task_assigned_to').find("[data-id= " + task_id + "]").val();
    var edit_dueDate = $('.due_date').find("[data-id= " + task_id + "]").val();
    var edit_title =  $('.task_title').find("[data-id= " + task_id + "]").val();
    var edit_content = $('.task_content').find("[data-id= " + task_id + "]").val();
    var edit_isCompleted = 0;

    if (document.getElementById(task_id).checked) {
        edit_isCompleted = 1;//set as completed
    }

    $.get(Routing.generate('edit', {task_id : task_id, assigned : edit_assigned, dueDate : edit_dueDate, title : edit_title,  content : edit_content, isCompleted : edit_isCompleted}),
        function(response) {
           if (response == 1) {
               if (edit_isCompleted == 1){
                   alert('Task updated successfully and marked as complete');
                   window.location.reload();
               } else {
                   alert('Task updated successfully');
                   window.location.reload();
               }
            } else {
                alert('Failed to update task');
            }
        });
});
/*
 Task edit cancel
 */

$('.back').click(function(){
    var task_id = $(this).data('id');
    //hide/show stuff smooth, works only once
    $('.task_block').find("[data-id= " + task_id + "]").prop('disabled', true);
    $('.task_assigned_to').find("[data-id= " + task_id + "]").addClass('disabled').css('border-bottom','none');
    $('.due_date').find("[data-id= " + task_id + "]").addClass('disabled').css('border-bottom','none');
    $('.task_title').find("[data-id= " + task_id + "]").addClass('disabled').css('border-bottom','none');
    $('.task_content').find("[data-id= " + task_id + "]").addClass('disabled').css('border-bottom','none');
    $('.complete_label').find("[data-id= " + task_id + "]").addClass('hidden');
    $('.save_task_button').find("[data-id= " + task_id + "]").addClass('save_hidden');
    $('.cancel_task_button').find("[data-id= " + task_id + "]").addClass('cancel');
    $('.edit_task_button').find("[data-id= " + task_id + "]").show().prop('disabled', false);
    //window.location.reload();
});

$('.toggle_completed').click(function(){
    var txt = $('.task_completed_block').is(':visible') ? 'Show completed tasks' : 'Hide completed tasks';
    $('.toggle_completed').text(txt);
    $('div.task_completed_block').toggle(function() {
        if ($(this).is(':visible'))
            $(this).css('display','inline-block')
    });
});

