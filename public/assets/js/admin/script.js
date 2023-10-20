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

    // Category
    if (window.location.href === route("admin.categories.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".category_dt"), route("admin.categories.index"), columns);
    }

    //User;
    if (window.location.href === route("admin.users.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "avatar",
                render(data) {
                    return handleNullAvatar(data);
                },
            },
            { data: "name" },
            {
                data: "email_verified_at",
                render(data) {
                    return isVerified(data);
                },
            },
            // {
            //     data: "role",
            //     render(data) {
            //         return `<span class='badge badge-primary'>${data}</span>`;
            //     },
            // },
            {
                data: "is_activated",
                render(data) {
                    return isActivated(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".user_dt"), route("admin.users.index"), columns);
    }
});

//=========================================================
// Custom Functions()
