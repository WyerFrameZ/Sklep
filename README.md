# 💎 SKLEP

## 🎰 O projekcie  
Ten projekt to nowoczesny sklep 

# Postawienie bazy danych:
1.Utworzenie bazy `sklep`
```sql
CREATE DATABASE sklep;
```
2.Utworzenie tabeli `urzytkownicy`
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    haslo VARCHAR(255) NOT NULL
);
```
3.Utworzenie tabeli `produkty`
```sql
CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opis` text DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL,
  `kategoria` varchar(50) NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### 🌟 Kluczowe funkcje:
1. **Handel samochodami**:
   - Dodawanie ogłoszeń sprzedaży aut (ze zdjęciami, opisami i cenami jak w otomoto, olx).
   - Jak się uda to będzie wyszukiwarka ofert z filtrami (marka, model, rocznik, cena).

2. **Kasyno online**:
   - Popularne gry hazardowe, takie jak **ruletka**, **blackjack**, **poker** i **sloty**.
   - System walutowy umożliwiający korzystanie z wygranych w celu zakupu towarów na platformie.
   - Ranking graczy z punktami zdobywanymi podczas rozgrywki.

4. **Bezpieczeństwo i przejrzystosć**:
   - Zabezpieczone transakcje płatnicze z wykorzystaniem **SSL**.
   - Bezbieczna baza danych z szyfrowaniem urzytkowników
   - Recenzje i oceny użytkowników dla sprzedawców.

5. **Dodatkowe funkcjonalności**:
   - Panel administracyjny dla zarządzania treścią i moderacją użytkowników.
   - Responsywny design – działa zarówno na komputerach, jak i urządzeniach mobilnych.

---

## 🛠️ Technologie  

- **Frontend**:  
  - HTML, CSS3 , JavaScript.  
  - walic badziewne tailwindy i inne takie tylko css B)

- **Backend**:  
  - Node.js z Express.j oraz PHP  
  - System bazy danych: **Postgresql**.  
  - Prywatny server.  

- **Inne**:
  - Bezpieczny i sprawdzony system logowania
  - Zoptymalizowana strona ( nie krozysta z gotowych elementów tylko wsyzstko jest pisane od 0 )

---
