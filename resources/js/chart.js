document.addEventListener("DOMContentLoaded", function () {
    Livewire.on("seismic-data-updated", (newReading) => {
        updateWaveform(newReading);
    });

    const chartDiv = document.getElementById("waveform-chart");
    const width = chartDiv.clientWidth;
    const height = chartDiv.clientHeight;
    const margin = 10;

    const svg = d3.select("#waveform-chart")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .style("background", "#f3f4f6"); // Sesuai bg-gray-50

    // Skala X tanpa batas (real-time berjalan)
    const xScale = d3.scaleTime()
        .domain([new Date(), new Date(Date.now() + 60000)]) // Mulai dari sekarang
        .range([margin, width - margin]);

    let yScale = d3.scaleLinear().domain([10, 10000]).range([height - margin, margin]);

    const xAxis = d3.axisBottom(xScale)
        .ticks(d3.timeMinute.every(1)) // Tick setiap 1 menit
        .tickFormat(d3.timeFormat("%H:%M:%S")); // Format HH:MM:SS

    let yAxis = d3.axisLeft(yScale).ticks(5);

    const gX = svg.append("g")
        .attr("transform", `translate(0,${height - margin})`)
        .attr("color", "#555")
        .call(xAxis);

    let gY = svg.append("g")
        .attr("transform", `translate(${margin},0)`)
        .attr("color", "#555")
        .call(yAxis);

    const line = d3.line()
        .x(d => xScale(new Date(d.timestamp)))
        .y(d => yScale(d.adc_counts))
        .curve(d3.curveLinear);

    let readings = [];

    const path = svg.append("path")
        .attr("fill", "none")
        .attr("stroke", "#4CAF50")
        .attr("stroke-width", 2);

    function updateWaveform(newReading) {
        readings.push(newReading);
        if (readings.length > 3000) readings.shift(); // Hindari terlalu banyak data

        // Periksa nilai maksimum ADC
        const maxADC = d3.max(readings, d => d.adc_counts);
        
        // Ubah skala Y sesuai nilai maksimum
        if (maxADC > 10000) {
            yScale.domain([10000, 20000]); // Skala 10.000 - 20.000
        } else {
            yScale.domain([10, 10000]); // Skala normal 10 - 10.000
        }

        // Update skala X agar terus berjalan (geser domain ke depan)
        const now = new Date();
        xScale.domain([new Date(now - 60000), now]); // 1 menit terakhir

        path.datum(readings)
            .attr("d", line);

        gX.call(xAxis); // Update sumbu-X
        gY.call(d3.axisLeft(yScale).ticks(5)); // Update sumbu-Y
    }
});
