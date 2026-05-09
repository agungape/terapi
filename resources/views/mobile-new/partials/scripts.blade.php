<script>
    let myChart = null;
    function initChart() {
        const canvas = document.getElementById('progressChart');
        if (!canvas) return;

        if (myChart) { myChart.destroy(); }

        const ctx = canvas.getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(255, 255, 255, 0.6)');
        gradient.addColorStop(0.7, 'rgba(255, 255, 255, 0.2)');
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Nov', 'Des', 'Jan', 'Feb', 'Mar'],
                datasets: [{
                    data: [40, 55, 65, 85, 92],
                    borderColor: '#ffffff',
                    borderWidth: 4,
                    backgroundColor: gradient,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#a855f7',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#6366f1',
                        bodyColor: '#4b5563',
                        borderColor: '#c7d2fe',
                        borderWidth: 1,
                        cornerRadius: 12
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true,
                        max: 100
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: 'rgba(255,255,255,0.9)',
                            font: {
                                weight: 'bold',
                                size: 11,
                                family: 'Quicksand'
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear'
                    }
                }
            }
        });

        myChart.update();
    }
</script>
