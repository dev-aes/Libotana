const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Activity Logs
    // if (window.location.href === route("city_admin.activity.index")) {
    //     const activitylog_data = [
    //         { data: "id" },
    //         { data: "description" },
    //         {
    //             data: "created_at",
    //             render(data) {
    //                 return formatDate(data, "datetime");
    //             },
    //         },
    //         { data: "actions", orderable: false, searchable: false },
    //     ];
    //     c_index(
    //         $(".activitylog_dt"),
    //         route("city_admin.activity.index"),
    //         activitylog_data
    //     );
    // }
    // Role
    // if (window.location.href === route("admin.role.index")) {
    //     const role_data = [
    //         {
    //             data: "name",
    //             render(data) {
    //                 return `<span class='text-capitalize badge bg-info p-2'>${data}</span>`;
    //             },
    //         },
    //     ];
    //     c_index($(".role_dt"), route("admin.role.index"), role_data);
    // }
});

//=========================================================
// Custom Functions()
