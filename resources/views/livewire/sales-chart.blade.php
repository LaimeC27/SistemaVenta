<!-- resources/views/livewire/sales-chart.blade.php -->

<div>
    <canvas wire:ignore id="myChart"></canvas>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                const ctx = document.getElementById('myChart');

                window.livewire.on('updateChart', function (data) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '# of Votes',
                                data: data.data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</div>
