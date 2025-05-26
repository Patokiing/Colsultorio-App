import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Table } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import styles from './CitasAtendidas.module.css'; // Importando el CSS Module

const CitasAtendidas = () => {
  const [citas, setCitas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchCitas = async () => {
      const token = localStorage.getItem('token');
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
        // Filtrar solo las citas con estado "Atendida"
        const citasAtendidas = response.data.filter(cita => cita.estado === 'Atendida');
        setCitas(citasAtendidas);
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
    <div className={styles.citasAtendidasPage}>
   <nav className={styles['top-bar']}>
                    <div className={styles['logo-container']}>
                      <img src="../img/logo.png" alt="Logo" className={styles.logo} />
                      <p className={styles['mediconnect-text']}>MEDICONNECT</p>
                    </div>
            
                  
                  
                  </nav>
            
      <div className={styles.citasContainer}>
        <div className={styles.citasWrapper}>
          <h1>Historial de Citas</h1>
       
          <Table striped bordered hover className={styles.table}>
            <thead>
              <tr>
                <th>#</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th> {/* Nueva columna para el botón */}
              </tr>
            </thead>
            <tbody>
              {citas.map((cita, index) => (
                <tr key={index}>
                  <td>{index + 1}</td>
                  <td>{cita.especialidad && cita.especialidad.nombre}</td>
                  <td>{cita.fech}</td>
                  <td>{cita.estado}</td>
                  <td>
                    {/* Botón para ver la receta */}
                    <Link to={`/ver-receta/${cita.id}`} className={styles['btn-ver-receta']}>
                      Ver Receta
                      <div className={styles['arrow-wrapper']}>
                        <div className={styles['arrow']}></div>
                      </div>
                    </Link>
                  </td>
                </tr>
              ))}
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  );
};

export default CitasAtendidas;