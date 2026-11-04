<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Reservas</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fe;
            color: #1e293b;
        }

        /* Menu de Navegação Limpo */
        .menu-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            display: block;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            color: #64748b;
        }
        .menu-card:hover {
            background-color: #f8fafc;
            color: #4338ca;
        }
        .menu-card.active {
            background-color: #e0e7ff; /* Fundo azul bem suave */
            color: #4338ca;
            font-weight: 600;
        }

        /* Card Principal da Tabela */
        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .card-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.5rem 2rem;
        }

        /* Botão Nova Reserva */
        .btn-add {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            color: white;
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(67, 56, 202, 0.2);
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 56, 202, 0.3);
            color: white;
        }

        /* Tabela Ultra Limpa */
        .table > :not(caption) > * > * {
            padding: 1.25rem 2rem;
            vertical-align: middle;
            border-bottom-color: #f1f5f9;
        }
        .table thead th {
            background-color: #ffffff;
            color: #64748b;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            border-bottom: 2px solid #e2e8f0;
        }
        .table tbody tr:hover { background-color: #f8fafc; }

        /* Avatar do Professor */
        .avatar {
            width: 40px;
            height: 40px;
            background: #f1f5f9; /* Cinza claro */
            color: #475569;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* Tags de Recursos SUTIS */
        .badge-resource {
            background-color: #f8fafc;
            color: #334155;
            padding: 0.35rem 0.7rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            border: 1px solid #e2e8f0;
        }

        /* Ícones de Ação Limpos */
        .action-icon {
            color: #94a3b8;
            background: none;
            border: none;
            padding: 4px;
            transition: 0.2s;
            text-decoration: none;
        }
        .action-icon.edit:hover { color: #4338ca; }
        .action-icon.delete:hover { color: #e11d48; }

    </style>
</head>
<body class="p-4 p-md-5">

    <div class="container" style="max-width: 1200px;">
        
        <div class="mb-5">
            <p class="text-secondary mb-1 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Visão Geral</p>
            <h2 class="fw-bold text-dark" style="letter-spacing: -1px;">Painel de <span style="color: #4338ca;">Reservas</span></h2>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-6 col-md-3">
                <a href="{{ route('reservas.index') }}" class="menu-card active">
                    <i class="bi bi-calendar-check d-block mb-1 fs-5"></i>
                    RESERVAS
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('professores.index') }}" class="menu-card">
                    <i class="bi bi-person-badge d-block mb-1 fs-5"></i>
                    PROFESSORES
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('equipamentos.index') }}" class="menu-card">
                    <i class="bi bi-pc-display d-block mb-1 fs-5"></i>
                    EQUIPAMENTOS
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('salas.index') }}" class="menu-card">
                    <i class="bi bi-door-open d-block mb-1 fs-5"></i>
                    SALAS
                </a>
            </div>
        </div>

        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center p-4">
                <h6 class="mb-0 fw-bold text-secondary text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Agenda de Utilização</h6>
                <a href="{{ route('reservas.create') }}" class="btn-add text-decoration-none">
                    <i class="bi bi-plus-lg me-1"></i> Nova Reserva
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Solicitante</th>
                            <th>Espaço Alocado</th>
                            <th>Equipamento Adicional</th>
                            <th>Cronograma</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        
                        @php
                            date_default_timezone_set('America/Sao_Paulo');
                            $hoje = date('Y-m-d');
                            $agora = date('H:i:s');
                            
                            $isHoje = $reserva->data_reserva == $hoje;
                            $isNoHorario = $agora >= $reserva->hora_inicio && $agora <= $reserva->hora_fim;
                            
                            $emAndamento = $isHoje && $isNoHorario;
                        @endphp

                        <tr class="{{ $emAndamento ? 'table-success' : '' }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3 bg-white border">
                                        @php
                                            $nomes = explode(' ', $reserva->professor->nome);
                                            $iniciais = strtoupper(substr($nomes[0], 0, 1));
                                            if (count($nomes) > 1) {
                                                $iniciais .= strtoupper(substr(end($nomes), 0, 1));
                                            }
                                        @endphp
                                        {{ $iniciais }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $reserva->professor->nome }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">Docente</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($reserva->sala)
                                    <span class="badge-resource bg-white">
                                        {{ $reserva->sala->descricao ?? $reserva->sala->nome }}
                                    </span>
                                @else
                                    <span class="text-secondary opacity-50" style="font-size: 0.85rem; font-style: italic;">
                                        Apenas Equipamento
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($reserva->equipamento)
                                    <span class="badge-resource bg-white">
                                        {{ $reserva->equipamento->descricao }}
                                    </span>
                                @else
                                   <span class="text-secondary opacity-50" style="font-size: 0.85rem; font-style: italic;">
                                        Sem equipamentos
                                    </span> 
                                @endif
                            </td>

                            <td>
                                <div class="text-dark fw-medium mb-1">
                                    {{ date('d/m/Y', strtotime($reserva->data_reserva)) }}
                                </div>
                                <div class="text-secondary small">
                                    {{ date('H:i', strtotime($reserva->hora_inicio)) }} – {{ date('H:i', strtotime($reserva->hora_fim)) }}
                                </div>
                                
                                @if($emAndamento)
                                    <div class="mt-2">
                                        <span class="badge rounded-pill text-bg-success d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm">
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" style="width: 10px; height: 10px;"></span>
                                            EM USO AGORA
                                        </span>
                                    </div>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('reservas.edit', $reserva->id) }}" class="action-icon edit" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" id="form-delete-{{ $reserva->id }}" class="m-0">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="button" class="action-icon delete" onclick="confirmDelete({{ $reserva->id }})" title="Cancelar">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted opacity-50 mb-3">
                                    <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Agenda Livre</h6>
                                <p class="text-muted small mb-0">Nenhum agendamento localizado para os próximos dias.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Cancelar Reserva?',
            text: "O horário e os recursos associados serão liberados imediatamente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Sim, cancelar',
            cancelButtonText: 'Manter',
            reverseButtons: true,
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        })
    }
    
    @if(session('successo'))
        Swal.fire({
            icon: 'success',
            title: 'Tudo Certo!',
            text: "{{ session('successo') }}",
            timer: 3000,
            showConfirmButton: false,
            customClass: { popup: 'rounded-4' }
        });
    @endif
    </script>
</body>
</html>