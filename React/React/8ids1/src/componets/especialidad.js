import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Container, Form, Nav, Navbar, Button } from 'react-bootstrap'
import { useNavigate, useParams } from 'react-router-dom';

function Especialidad() {

    const [nombre, setNombre] = useState('');
    const navigate = useNavigate();
    const {id} = useParams();

    useEffect(() => {
        if(id){
            fnEspecialidad()
        }
    },[])

    const fnEspecialidad = async () => {
        const response = await axios.post('http://127.0.0.1:8000/api/especialidad',{
            'id' : id
        })

        setNombre(response.data.nombre)
    }

    const fnGuardar = async (e) => {
        e.preventDefault();
    
          const response = await axios.post('http://127.0.0.1:8000/api/especialidad/guardar',{
            'id' : id,
            'nombre' : nombre 
          })
    
          if(response.data == "ok"){
            navigate('/home')
          }
      }
    
  return (
    <div>
        <Navbar bg="dark" data-bs-theme="dark">
        <Container>
          <Navbar.Brand href="#home">UTTEC</Navbar.Brand>
          <Nav className="me-auto">
            <Nav.Link href="#home">Especialidades</Nav.Link>
            <Nav.Link href="#features">Doctores</Nav.Link>
            <Nav.Link href="#pricing">Consultorios</Nav.Link>
          </Nav>
        </Container>
      </Navbar>
      <Container className='mt-4'>
        <h1>Especialidades</h1>
        <Form>
            <Form.Group controlId='frmNombre'>
                <Form.Label>Nombre</Form.Label>
                <Form.Control type='text' value={nombre} onChange={(e) => setNombre(e.target.value)} placeholder='Nombre de la especialidad'>
                </Form.Control>
            </Form.Group>
            <Button onClick={fnGuardar}>Guardar</Button>
        </Form>
        </Container>
    </div>
  )
}

export default Especialidad