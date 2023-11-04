-------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `avatar` text NOT NULL DEFAULT 'assets/images/avatars/avatar.png',
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `fullname`, `avatar`, `password`) VALUES
(1, 'admin', 'rajiaegigogo@auk.edu.ng', 'Raji Abdullahi Egigogo', 'assets/images/avatars/avatar.png', '$2y$10$.aecC26Ps8d2rF58CVyvKuPo/6BEHPA.N7XQA5gBPsf56UbF7eHiq');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `questionsCount` int(50) NOT NULL,
  `instructions` text NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `questionsCount`, `instructions`, `duration`) VALUES
(1, 'Al-ASAS WINTER EXAMS 2023', 10, '&lt;p&gt;Exam Instructions:&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;1. Read the instructions carefully: Before starting the exam, make sure you read all the instructions provided on each section of the exam paper.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;2. Time management: The total duration of the exam is [duration]. Manage your time effectively and allocate appropriate time for each section. Be mindful of the time remaining and pace yourself accordingly.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;3. Answer all questions: Attempt all the questions in the exam. Even if you are unsure of the answer, provide your best attempt as partial credit may be awarded for partially correct answers.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;4. Follow the format: Write your answers in the provided answer booklet or sheets. Follow the prescribed format and use a pen or pencil as instructed.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;5. Use of calculators: For sections that involve calculations, you may use calculators unless specified otherwise. Ensure that your calculator is allowed and approved for use in the exam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;GOOD LUCK!&lt;/p&gt;', 0),
(2, 'AL-ASAS SUMMER EXAMS 2023', 20, '&lt;p&gt;Exam Instructions:&lt;br&gt;&lt;/p&gt;&lt;p&gt;1. Read each question carefully: Carefully read each question before attempting to answer. Pay attention to the requirements, such as providing multiple-choice options or showing the complete working for a math problem.&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;2. Manage your space: Write legibly and neatly. Use appropriate headings, subheadings, and bullet points to organize your answers. Use separate paragraphs for different parts of a question, if required.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;3. Review your answers: Once you have completed the exam, review your answers. Check for any errors or omissions. If time permits, go through your answers again to ensure accuracy.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;4. Submission: At the end of the exam, ensure that you have included all the required information on your answer booklet or sheets. Follow the instructions for submitting your exam, whether it&#039;s collecting and handing in physical papers or submitting electronically.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;1 Academic integrity: Maintain the highest standards of academic integrity during the exam. Do not engage in any form of cheating, plagiarism, or unauthorized collaboration. Any violation of academic integrity will result in severe consequences.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Remember to stay calm and focused during the exam. If you have any doubts or need clarification, raise your hand and ask for assistance from the invigilator or instructor. Good luck!&lt;/p&gt;', 0),
(3, 'AL-ASAS SPRING EXAMS 2023', 10, '&lt;p&gt;Instructions&lt;/p&gt;&lt;ol&gt;&lt;li&gt;1. DOnt refresh the page&lt;/li&gt;&lt;li&gt;2 SUBMIT WHEN YOU ARE DONE&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;GOOD LUCK&lt;/p&gt;', 0),
(4, '2023 ENTRANCE EXAMS', 50, '&lt;p&gt;Login with your email address or your phone number&lt;/p&gt;&lt;p&gt;Attempt all Questions&lt;/p&gt;&lt;p&gt;Time Allowed 30min&lt;/p&gt;&lt;p&gt;Make sure you click Submit button when you are done&lt;/p&gt;', 30);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(100) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `question` text NOT NULL,
  `optionA` varchar(50) NOT NULL,
  `optionB` varchar(50) NOT NULL,
  `optionC` varchar(50) NOT NULL,
  `optionD` varchar(50) NOT NULL,
  `correctAnswer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_id`, `question`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAnswer`) VALUES
(1, 1, 'What is the plural of \"child\"?', 'Childs', 'Childrens', 'Childes', 'Children', 'optionD'),
(3, 1, 'Which word is a synonym for \"happy\"?', 'Sad', 'Joyful', 'Angry', 'Tired', 'optionB'),
(4, 1, 'What is the opposite of \"brave\"?', 'Fearful', 'Cowardly', 'Daring', 'Courageous', 'optionB');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(50) NOT NULL,
  `exam_id` int(50) NOT NULL,
  `student_id` varchar(200) NOT NULL,
  `courses_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`courses_score`)),
  `total_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `exam_id`, `student_id`, `courses_score`, `total_score`) VALUES
(1, 3, 'adamufura98@gmail.com', '{\"1\":3,\"2\":0,\"5\":1,\"6\":0}', 4),
(2, 2, 'adamufura98@gmail.com', '{\"1\":1,\"2\":0,\"3\":0,\"5\":0,\"6\":0}', 1),
(3, 2, 'shehu@gmail.com', '{\"1\":2,\"2\":0,\"6\":0,\"5\":0}', 2),
(4, 1, 'adamufura98@gmail.com', '{\"1\":2}', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `allocation` int(20) NOT NULL DEFAULT 0,
  `joined` date NOT NULL DEFAULT current_timestamp(),
  `avatar` text NOT NULL DEFAULT '../assets/images/avatars/avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `email`, `phonenumber`, `fullname`, `status`, `allocation`, `joined`, `avatar`) VALUES
(1, 'adamufura98@gmail.com', '08166644083', 'Adamu Suleiman', 'ACTIVE', 4, '2023-06-25', '../assets/images/avatars/adamufura98@gmail.com.png'),
(2, 'shehu@gmail.com', '08123456789', 'Shehu Suleiman', 'ACTIVE', 2, '2023-06-25', '../assets/images/avatars/avatar.png'),
(3, 'student1@example.com', '12345678901', 'John Doe', 'ACTIVE', 1, '2023-06-25', '../assets/images/avatars/avatar.png'),
(4, 'student2@example.com', '23456789012', 'Jane Smith', 'ACTIVE', 1, '2023-06-25', '../assets/images/avatars/avatar.png'),
(5, 'student3@example.com', '34567890123', 'Alice Johnson', 'INACTIVE', 0, '2023-06-25', '../assets/images/avatars/avatar.png'),
(6, 'student4@example.com', '45678901234', 'David Lee', 'ACTIVE', 3, '2023-06-25', '../assets/images/avatars/avatar.png'),
(8, 'adamufura99@gmail.com', '08123456787', 'Adamu Fura Suleiman', 'ACTIVE', 0, '2023-06-27', '../assets/images/avatars/avatar.png'),
(9, 'ibrahimsfura03@gmai.com', '08033698607', 'Ibrahim Suleiman', 'ACTIVE', 0, '2023-06-28', '../assets/images/avatars/ibrahimsfura03@gmai.com.png'),
(12, 'abdullahirajiegigogo@gmail.com', '07030638923', 'Makun Raji', 'ACTIVE', 4, '2023-07-01', '../assets/images/avatars/avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `description`) VALUES
(7, 'ENG, MATH, BIO, CHEM, PHY &amp; CURRENT AFFAIRS', 'ENTRANCE EXAM FOR 2023/2024 ACADEMIC SESSION');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
