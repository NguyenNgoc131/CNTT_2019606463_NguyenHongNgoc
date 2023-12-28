$(document).ready(function() {
    $("#addExpertBtn").click(function() {
        $("#addExpertForm").show();
        $("#addExpertBtn").hide();
    });

    $("#cancelExpertBtn").click(function() {
        $("#addExpertForm").hide();
        $("#addExpertBtn").show();
    });
});