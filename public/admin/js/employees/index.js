// resources/views/admin/employees/index.blade.php sets window.employeesDataUrl
// before this file loads — Blade syntax can't be used inside a plain .js file.

$(function () {
    const statusMap = {
        1: { label: "Active", classes: "bg-emerald-500/10 text-emerald-400" },
        0: { label: "Inactive", classes: "bg-rose-500/10 text-rose-400" },
        // 2: { label: "On Leave", classes: "bg-amber-500/10 text-amber-400" },
    };

    const table = $("#employeesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: window.employeesDataUrl,

        columns: [
            {
                data: "first_name",
                render: function (data, type, row) {
                    const fullName = `${row.first_name} ${row.last_name}`;
                    const avatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=1f2530&color=ffffff`;
                    const designationName = row.designation
                        ? row.designation.name
                        : "—";

                    return `
                        <a href="employees/show/${row.id}" class="flex items-center gap-3 group">
                            <img src="${avatar}" class="w-9 h-9 rounded-full" alt="">
                            <div>
                                <p class="text-gray-200 font-medium group-hover:text-indigo-400 transition">${fullName}</p>
                                <p class="text-xs text-gray-500">${designationName}</p>
                            </div>
                        </a>`;
                },
            },
            { data: "email" },
            {
                data: "joining_date",
                render: function (data) {
                    const date = new Date(data);
                    return date.toLocaleDateString("en-IN", {
                        day: "2-digit",
                        month: "short",
                        year: "numeric",
                    });
                },
            },
            {
                data: "status",
                render: function (data) {
                    // data is a NUMBER here (e.g. 1), not a string —
                    // that's exactly why .replace() failed before.
                    const status = statusMap[data] || {
                        label: "Unknown",
                        classes: "bg-gray-500/10 text-gray-400",
                    };
                    return `<span class="px-2.5 py-1 rounded-full text-xs font-medium ${status.classes}">${status.label}</span>`;
                },
            },
            {
                data: "id",
                orderable: false,
                searchable: false,
                className: "text-right",
                render: function (data) {
                    // Same idea as designation_name above — there is no "action"
                    // field in the JSON at all right now. We build the show-page
                    // URL ourselves from the row's real id instead.
                    return `<a href="/admin/employees/${data}" class="text-gray-500 hover:text-indigo-400 transition inline-flex p-1.5 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>`;
                },
            },
        ],
    });

    // DataTables fires this every time it fetches new data from the server
    // (first load, page change, search, sort — all trigger it).
    table.on("xhr", function () {
        const json = table.ajax.json();
        if (json) {
            $("#employee-count").text(json.recordsTotal + " total employees");
        }
    });
});
