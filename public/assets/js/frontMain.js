$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });


    // Select Current Page 
    // Select Current Page 
    // Select Current Page 



        // Get the current URL path
        var currentUrl = window.location.pathname;


        // Function to add the 'active' class and handle nested menus
        function setActiveLinks() {
            // Iterate over each link in the sidebar
            $('#sidebarnav a').each(function() {
                var linkUrl = $(this).attr('href');
                // Check if the link URL matches the current URL
                // Create an anchor element
                var anchor = $('<a>').attr('href', linkUrl);

                // Extract the pathname
                var pathname = anchor[0].pathname;

                if (pathname === currentUrl) {
                    $(this).addClass('active');
                    // Find the closest <li> parent and add 'active' class
                    $(this).closest('li').addClass('active');
                    $(this).closest('ul').removeClass('collapse');

                    $(this).closest('ul').addClass('collapse show');

                    // Check if this <li> has a nested <ul>
                    var parentLi = $(this).closest('li');
                    var nestedUl = parentLi.find('ul');
                    if (nestedUl.length) {
                        // Expand the nested <ul>
                        nestedUl.addClass('collapse show'); // or use 'collapse show' depending on your bootstrap version
                    }
                }
            });
        }
        // Call the function to set the active links
        setActiveLinks();


    // Select Current Page
    // Select Current Page
    // Select Current Page






        // Auto Select Date
        // Auto Select Date
        // Auto Select Date


        if($("#start_date_day_english").length){

        
        var today = moment();
        var hijriDate = today.format('iYYYY-iM-iD'); // Hijri date format
    
        // Parse Hijri date
        var [hijriYear, hijriMonth, hijriDay] = hijriDate.split('-').map(Number);
    
        // Set the current date in the English dropdowns
        document.getElementById('start_date_day_english').value = today.date();
        document.getElementById('start_date_month_english').value = today.month() + 1; // Months are zero-based
        document.getElementById('start_date_year_english').value = today.year();
    
        // Set the current date in the Arabic dropdowns
        document.getElementById('start_date_day_arabic').value = hijriDay;
        document.getElementById('start_date_month_arabic').value = hijriMonth;
        document.getElementById('start_date_year_arabic').value = hijriYear;


        document.getElementById('end_date_day_english2').value = today.date();
        document.getElementById('end_date_month_english2').value = today.month() + 1; // Months are zero-based
        document.getElementById('end_date_year_english2').value = today.year();
    
        // Set the current date in the Arabic dropdowns
        document.getElementById('end_date_day_arabic2').value = hijriDay;
        document.getElementById('end_date_month_arabic2').value = hijriMonth;
        document.getElementById('end_date_year_arabic2').value = hijriYear;

    
        // Toggle Date Format
        var toggleCheckbox = document.getElementById('toggleDateFormat');
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Select all elements with the class 'english-date' and hide them
                document.querySelectorAll('.english-date').forEach(function(element) {
                    element.style.display = 'none';
                });
                
                // Select all elements with the class 'arabic-date' and show them
                document.querySelectorAll('.arabic-date').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else {
                // Select all elements with the class 'english-date' and show them
                document.querySelectorAll('.english-date').forEach(function(element) {
                    element.style.display = 'flex';
                });
                
                // Select all elements with the class 'arabic-date' and hide them
                document.querySelectorAll('.arabic-date').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
            
        });
    
        // Set initial state
        document.querySelector('.arabic-date').style.display = 'none';

    }


        // ***********************************
        window.toggleCheckbox = function(label) {
            const $label = $(label);
            const $checkbox = $label.find('input[type="checkbox"]');
            
            if ($checkbox.length) {
                $checkbox.prop('checked', !$checkbox.prop('checked'));
                $label.toggleClass('active', $checkbox.prop('checked'));
            }
        }
        // ***********************************


        if($("#toggleInstructions").length){

                // Toggle Instructions
            document.getElementById('toggleInstructions').addEventListener('click', function () {
                let instructionsDiv = document.getElementById('instructions');
                if (instructionsDiv.style.display === "none" || instructionsDiv.style.display === "") {
                    instructionsDiv.style.display = "block";
                } else {
                    instructionsDiv.style.display = "none";
                }
            });

            // Toggle Instructions
            document.getElementById('toggleInstructions2').addEventListener('click', function () {
                let instructionsDiv = document.getElementById('instructions2');
                if (instructionsDiv.style.display === "none" || instructionsDiv.style.display === "") {
                    instructionsDiv.style.display = "block";
                } else {
                    instructionsDiv.style.display = "none";
                }
            });
        }


        if($("#statsChart").length){

            const ctx = document.getElementById('statsChart').getContext('2d');

            const statsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024'],
                    datasets: [
                        {
                            label: 'عدد حضور المعلمين',
                            data: [50,60,70], // Initial value for Strength
                            borderColor: '#d95d13',
                            backgroundColor: '#d95d1320',
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'عدد حضور الطلاب',
                            data: [30,10,20], // Initial value for Agility
                            borderColor: '#0a65af',
                            backgroundColor: '#0a65af20',
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true // Show the legend to differentiate the lines
                        }
                    }
                }
            });
            
            function increaseStat(index, increment) {
                const dataset = statsChart.data.datasets[index];
                const newValue = Math.min((dataset.data[dataset.data.length - 1] || 0) + increment, 100);
                dataset.data.push(newValue); // Add the new value to the dataset
                statsChart.update();
            }
    }


    if($(".table-stats").length){

        function updateStats() {
            let absenceCount = 0;
            let lateCount = 0;

            // Loop through each row in the table body
            $('table tbody tr').each(function() {
                // Get the text content of the "status" column (6th column, index 5)
                let statusText = $(this).find('td').eq(5).text().trim().toLowerCase();

                if (statusText === 'absence') {
                    absenceCount++;
                } else if (statusText === 'late') {
                    lateCount++;
                }
            });

            // Update the stats in the h2 elements
            $('.table-stats .stat').eq(0).find('span').text(absenceCount);
            $('.table-stats .stat').eq(1).find('span').text(lateCount);
        }

        // Call the function to update the stats on page load
        updateStats();

        // Optionally, you can call updateStats again if the table data changes dynamically
    }



    if($("#start_date_day_arabic").length){
    // Function to convert Hijri date to Gregorian date using Moment.js and Moment-Hijri
    function hijriToGregorian(day, month, year) {
        let hijriDate = moment(`${year}-${month}-${day}`, 'iYYYY-iM-iD');
        let gregorianDate = hijriDate.format('YYYY-MM-DD'); // Convert to Gregorian and format as 'YYYY-MM-DD'
        return gregorianDate;
    }

    function updateHiddenDateInput() {
        const day = document.querySelector("#start_date_day_english")?.value;
        const month = document.querySelector("#start_date_month_english")?.value;
        const year = document.querySelector("#start_date_year_english")?.value;
    
        const day2 = document.querySelector("#end_date_day_english2")?.value;
        const month2 = document.querySelector("#end_date_month_english2")?.value;
        const year2 = document.querySelector("#end_date_year_english2")?.value;
    
        if (day && month && year) {
            document.querySelector(".hidden-date-input input[type='date']").value = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        }
    
        if (day2 && month2 && year2) {
            document.querySelector(".hidden-date-input2 input[type='date']").value = `${year2}-${month2.padStart(2, '0')}-${day2.padStart(2, '0')}`;
        }
    }
    

    // Event listeners for English date selects
    document.querySelectorAll(".english-date select").forEach(select => {
        select.addEventListener('change', updateHiddenDateInput);
    });

    // Event listeners for Arabic date selects
    document.querySelectorAll(".arabic-date select").forEach(select => {
        select.addEventListener('change', () => {
            const day = document.querySelector("#start_date_day_arabic").value;
            const month = document.querySelector("#start_date_month_arabic").value;
            const year = document.querySelector("#start_date_year_arabic").value;

            const day2 = document.querySelector("#end_date_day_arabic2").value;
            const month2 = document.querySelector("#end_date_month_arabic2").value;
            const year2 = document.querySelector("#end_date_year_arabic2").value;

            if (day && month && year) {
                const gregorianDate = hijriToGregorian(day, month, year);
                document.querySelector(".hidden-date-input input[type='date']").value = gregorianDate;
            }


            if (day2 && month2 && year2) {
                const gregorianDate = hijriToGregorian(day2, month2, year2);
                document.querySelector(".hidden-date-input2 input[type='date']").value = gregorianDate;
            }

        });
    });



    // Event listener for the toggle checkbox
    document.querySelector("#toggleDateFormat").addEventListener('change', function() {
        if (this.checked) {
            document.querySelector(".english-date").classList.add('hide');
            document.querySelector(".arabic-date").classList.remove('hide');
        } else {
            document.querySelector(".english-date").classList.remove('hide');
            document.querySelector(".arabic-date").classList.add('hide');
        }
    });

    // Initialize with default selection
    updateHiddenDateInput();
    }

    if (document.querySelectorAll('.print-table-pdf, .print-table-excel').length) {
        document.querySelectorAll('.print-table-pdf, .print-table-excel').forEach(button => {
            button.addEventListener('click', function() {
                const table = this.closest('.table-container').querySelector('table');
                const isPdf = this.classList.contains('print-table-pdf');
                if (isPdf) {
                    exportTableToPdf(table);
                } else {
                    exportTableToExcel(table);
                }
            });
        });

        function getSelectedRows(table) {
            const selectedRows = Array.from(table.querySelectorAll("input[name='selectedIds[]']:checked"))
                .map(checkbox => checkbox.closest('tr'));
            return selectedRows.length > 0 ? selectedRows : Array.from(table.querySelectorAll("tbody tr"));
        }
    
        function exportTableToPdf(table) {
            // Hide non-selected rows
            const allRows = table.querySelectorAll('tbody tr');
            const selectedRows = getSelectedRows(table);
            
            allRows.forEach(row => {
                if (!selectedRows.includes(row)) {
                    row.style.display = 'none';
                }
            });
    
            $("input[type='checkbox']").css('display', 'none');
    
            const tableTemplate = document.querySelector('.table-template');
            const clonedTable = table.cloneNode(true);
            tableTemplate.innerHTML = ''; // Clear previous content
            tableTemplate.appendChild(clonedTable);
    
            // Convert the table-template element to canvas with higher quality
            html2canvas(tableTemplate, { scale: 2 }).then(canvas => {
    
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF('p', 'pt', 'a4');
    
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = doc.internal.pageSize.width;
                const imgHeight = canvas.height * imgWidth / canvas.width;
    
                const pageHeight = doc.internal.pageSize.height;
                let heightLeft = imgHeight;
                let position = 0;
    
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
    
                while (heightLeft > 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
    
                doc.save('table.pdf');
    
                setTimeout(() => {
                    // Show all rows again
                    allRows.forEach(row => row.style.display = '');
                    $("input[type='checkbox']").css('display', 'block');
                }, 1000);
            });
        }
    
        function exportTableToExcel(table) {
            const selectedRows = getSelectedRows(table);
            const headers = Array.from(table.querySelectorAll('thead th'))
                .filter(th => !th.querySelector('input[type="checkbox"]'))
                .map(th => th.textContent.trim());
    
            const worksheetData = [headers];
    
            selectedRows.forEach(row => {
                const rowData = Array.from(row.querySelectorAll('td'))
                    .filter(td => !td.querySelector('input[type="checkbox"]'))
                    .map(td => td.textContent.trim());
                worksheetData.push(rowData);
            });
    
            const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "تقرير الموظفين");
    
            XLSX.writeFile(workbook, 'table.xlsx');
        }
    }
    
});