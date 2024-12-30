<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSS Grid - Large Data Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* คอลัมน์ปรับตามขนาดหน้าจอ */
      gap: 15px; /* ช่องว่างระหว่างกริด */
      padding: 20px;
    }

    .grid-item {
      background-color: #4CAF50;
      color: white;
      border-radius: 8px;
      padding: 20px;
      font-size: 16px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .grid-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      color: #333;
    }
  </style>
</head>
<body>
  <h1>CSS Grid - Large Data Example</h1>
  <div class="grid-container">
    <!-- สร้างข้อมูล 50 รายการ -->
    <div class="grid-item">Item 1</div>
    <div class="grid-item">Item 2</div>
    <div class="grid-item">Item 3</div>
    <div class="grid-item">Item 4</div>
    <div class="grid-item">Item 5</div>
    <div class="grid-item">Item 6</div>
    <div class="grid-item">Item 7</div>
    <div class="grid-item">Item 8</div>
    <div class="grid-item">Item 9</div>
    <div class="grid-item">Item 10</div>
    <div class="grid-item">Item 11</div>
    <div class="grid-item">Item 12</div>
    <div class="grid-item">Item 13</div>
    <div class="grid-item">Item 14</div>
    <div class="grid-item">Item 15</div>
    <div class="grid-item">Item 16</div>
    <div class="grid-item">Item 17</div>
    <div class="grid-item">Item 18</div>
    <div class="grid-item">Item 19</div>
    <div class="grid-item">Item 20</div>
    <div class="grid-item">Item 21</div>
    <div class="grid-item">Item 22</div>
    <div class="grid-item">Item 23</div>
    <div class="grid-item">Item 24</div>
    <div class="grid-item">Item 25</div>
    <div class="grid-item">Item 26</div>
    <div class="grid-item">Item 27</div>
    <div class="grid-item">Item 28</div>
    <div class="grid-item">Item 29</div>
    <div class="grid-item">Item 30</div>
    <div class="grid-item">Item 31</div>
    <div class="grid-item">Item 32</div>
    <div class="grid-item">Item 33</div>
    <div class="grid-item">Item 34</div>
    <div class="grid-item">Item 35</div>
    <div class="grid-item">Item 36</div>
    <div class="grid-item">Item 37</div>
    <div class="grid-item">Item 38</div>
    <div class="grid-item">Item 39</div>
    <div class="grid-item">Item 40</div>
    <div class="grid-item">Item 41</div>
    <div class="grid-item">Item 42</div>
    <div class="grid-item">Item 43</div>
    <div class="grid-item">Item 44</div>
    <div class="grid-item">Item 45</div>
    <div class="grid-item">Item 46</div>
    <div class="grid-item">Item 47</div>
    <div class="grid-item">Item 48</div>
    <div class="grid-item">Item 49</div>
    <div class="grid-item">Item 50</div>
  </div>
</body>
</html>
