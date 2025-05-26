import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Container, Form } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { useNavigate } from 'react-router-dom';
import styles from './Cita.module.css';

function Cita() {
    const [especialidades, setEspecialidades] = useState([]);
    const [fecha, setFecha] = useState('');
    const [especialidadSeleccionada, setEspecialidadSeleccionada] = useState('');
    const [hora, setHora] = useState('');
    const [horariosDisponibles, setHorariosDisponibles] = useState([]);
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        obtenerEspecialidades();
    }, []);

    const obtenerEspecialidades = async () => {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/especialidades');
            setEspecialidades(response.data);
        } catch (error) {
            console.error('Error al obtener especialidades:', error);
        }
    };

    // Obtener horarios disponibles cuando se selecciona una fecha
    useEffect(() => {
        if (fecha && especialidadSeleccionada) {
            obtenerHorariosDisponibles();
        }
    }, [fecha, especialidadSeleccionada]);

    const obtenerHorariosDisponibles = async () => {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/citas/horarios-disponibles', {
                params: {
                    fech: fecha,
                    id_espe: especialidadSeleccionada, // Enviamos el ID de la especialidad
                },
            });
            setHorariosDisponibles(response.data.horarios_disponibles);
        } catch (error) {
            console.error('Error al obtener horarios disponibles:', error);
            setHorariosDisponibles([]);
        }
    };

    const fnGuardarCita = async (e) => {
        e.preventDefault();
        if (!especialidadSeleccionada || !fecha || !hora) {
            setError('Debe seleccionar una especialidad, una fecha y una hora.');
            return;
        }
    
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token no encontrado.');
            setError('Debe iniciar sesión para registrar una cita.');
            return;
        }
    
        try {
            const response = await axios.post(
                'http://127.0.0.1:8000/api/citas/guardar',
                {
                    fech: fecha,
                    hora: hora,
                    id_espe: especialidadSeleccionada,
                },
                {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    },
                }
            );
    
            if (response.data.message === 'Cita guardada exitosamente.') {
                setEspecialidadSeleccionada('');
                setFecha('');
                setHora('');
                setError(null);
                navigate('/consultarcitas');
            } else {
                setError('Error al guardar la cita.');
            }
        } catch (error) {
            console.error('Error al guardar la cita:', error.response?.data || error.message);
    
            // Mostrar el mensaje de error devuelto por el backend
            if (error.response && error.response.data && error.response.data.error) {
                setError(error.response.data.error); // Mostrar el mensaje de error en la interfaz
            } else {
                setError('No se pudo guardar la cita. Intente nuevamente.');
            }
        }
    };

    return (
        <div className={styles.bienPage}>
            <nav className={styles['top-bar']}>
                <div className={styles['logo-container']}>
                    <img src="../img/logo.png" alt="Logo" className={styles.logo} />
                    <p className={styles['mediconnect-text']}>MEDICONNECT</p>
                </div>
            </nav>

            <Container className={styles.container}>
                <div className={styles.formWrapper}>
                    <h1>Generar Cita</h1>
                    <Form onSubmit={fnGuardarCita}>
                        <Form.Group controlId='frmEspecialidad'>
                            <Form.Label>Especialidad</Form.Label>
                            <Form.Control
                                as='select'
                                value={especialidadSeleccionada}
                                onChange={(e) => setEspecialidadSeleccionada(e.target.value)}
                            >
                                <option value="">Seleccione una especialidad</option>
                                {especialidades.map((especialidad) => (
                                    <option key={especialidad.id} value={especialidad.id}>{especialidad.nombre}</option>
                                ))}
                            </Form.Control>
                        </Form.Group>

                        <Form.Group controlId='frmFecha'>
                            <Form.Label>Fecha</Form.Label>
                            <Form.Control
                                type='date'
                                value={fecha}
                                onChange={(e) => setFecha(e.target.value)}
                            />
                        </Form.Group>

                        {fecha && (
                            <Form.Group controlId='frmHora'>
                                <Form.Label>Hora</Form.Label>
                                <Form.Control
                                    as='select'
                                    value={hora}
                                    onChange={(e) => setHora(e.target.value)}
                                >
                                    <option value="">Seleccione una hora</option>
                                    {horariosDisponibles.map((hora, index) => (
                                        <option key={index} value={hora}>{hora}</option>
                                    ))}
                                </Form.Control>
                            </Form.Group>
                        )}

                        <br />
                        {error && <div className={styles.errorMessage}>{error}</div>}
                        <center>
                            <button type="submit" className={styles.button}>
                                <span className={styles.buttonContent}>Guardar Cita</span>
                            </button>
                        </center>
                    </Form>
                </div>
            </Container>
        </div>
    );
}

export default Cita;