import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import WhatsAppButton from './components/WhatsAppButton';
import Home from './pages/Home';
import TentangKami from './pages/TentangKami';
import LayananKami from './pages/LayananKami';
import Informasi from './pages/Informasi';
import KlienKami from './pages/KlienKami';
export default function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/tentang-kami" element={<TentangKami />} />
        <Route path="/layanan-kami" element={<LayananKami />} />
        <Route path="/informasi" element={<Informasi />} />
        <Route path="/klien-kami" element={<KlienKami />} />
      </Routes>
      <Footer />
      <WhatsAppButton />
    </Router>
  );
}
