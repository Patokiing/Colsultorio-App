import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Table } from 'react-bootstrap';
import styles from './Consultarcitas.module.css'; // Importando el CSS Module

const Consultarcitas = () => {
  const [citas, setCitas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Se ejecuta al montar el componente
  useEffect(() => {
    const fetchCitas = async () => {
      const token = localStorage.getItem('token'); // Verifica si el token está almacenado
      if (!token) {
        setError('Debe iniciar sesión para ver las citas.');
        setLoading(false);
        return;
      }

      try {
        const response = await axios.get('http://127.0.0.1:8000/api/citas', {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: 'application/json',
          },
        });
        setCitas(response.data);
      } catch (error) {
        console.error('Error al obtener las citas:', error);
        setError('Hubo un problema al cargar las citas.');
      } finally {
        setLoading(false);
      }
    };

    fetchCitas();
  }, []);

  if (loading) {
    return <div className={styles.loadingMessage}>Cargando citas...</div>;
  }

  if (error) {
    return <div className={styles.errorMessage}>{error}</div>;
  }

  return (
    <div className={styles.consultarCitasPage}>
      <nav className={styles['top-bar']}>
        <div className={styles['logo-container']}>
          <img src="../img/logo.png" alt="Logo" className={styles.logo} />
          <p className={styles['mediconnect-text']}>MEDICONNECT</p>
        </div>
      </nav>
      <div className={styles.citasContainer}>
        <div className={styles.citasWrapper}>
          <h1>Consulta de Citas</h1>
          
          <Table striped bordered hover className={styles.table}>
            <thead>
              <tr>
                <th>#</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora</th> {/* Nueva columna para la hora */}
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              {citas.map((cita, index) => (
                <tr key={index}>
                  <td>{index + 1}</td>
                  <td>{cita.especialidad && cita.especialidad.nombre}</td>
                  <td>{cita.fech}</td>
                  <td>{cita.hora}</td> {/* Mostrar la hora de la cita */}
                  <td>{cita.estado}</td> {/* Mostrar el estado de la cita */}
                </tr>
              ))}
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  );
};

export default Consultarcitas;