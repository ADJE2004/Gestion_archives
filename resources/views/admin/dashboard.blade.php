<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenue Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-600"><i class="fas fa-users fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Utilisateurs</p>
                            <p class="text-2xl font-bold">{{ $stats['users_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full text-green-600"><i class="fas fa-building fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Services</p>
                            <p class="text-2xl font-bold">{{ $stats['services_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full text-purple-600"><i class="fas fa-file-alt fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Documents Total</p>
                            <p class="text-2xl font-bold">{{ $stats['docs_count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8">
            <div class="max-w-sm w-full bg-neutral-primary-soft border border-default rounded-base shadow-xs p-4 md:p-6">
  <div class="flex justify-between items-start">
    <div>
      <h5 class="text-2xl font-semibold text-heading">32.4k</h5>
      <div id="area-chart"></div>
      <p class="text-body">Users this week</p>
    </div>
    <div class="flex items-center px-2.5 py-0.5 font-medium text-fg-success text-center">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/></svg>
      12%
    </div>
  </div>
</div>
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4">Derniers documents archivés (Global)</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3 text-sm">Référence</th>
                                <th class="p-3 text-sm">Titre</th>
                                <th class="p-3 text-sm">Agent</th>
                                <th class="p-3 text-sm">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_docs'] as $doc)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-mono text-xs text-blue-600">{{ $doc->reference }}</td>
                                <td class="p-3 text-sm">{{ $doc->title }}</td>
                                <td class="p-3 text-sm">{{ $doc->user->name }}</td>
                                <td class="p-3 text-sm text-gray-500">{{ $doc->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
        const options = {
            chart: {
                height: "150px",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: { enabled: false },
                toolbar: { show: false },
            },
            tooltip: { enabled: true, x: { show: false } },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: { enabled: false },
            stroke: { width: 4, curve: "smooth" },
            grid: { show: false },
            series: [
                {
                    name: "Users",
                    data: [6500, 6418, 6456, 6526, 6356, 6456],
                    color: "#1A56DB",
                },
            ],
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                labels: { show: false },
                axisBorder: { show: false },
                axisTicks: { show: false },
            },
            yaxis: { show: false },
        };

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
    });
</script>
@endpush



</x-app-layout>


