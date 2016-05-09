<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_spjpSearch" connection="ConnSIKP" dataSource="select * from p_survey_question 
WHERE p_survey_type_id=2
order by sequence_no" returnPage="t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.ccp" PathID="t_rep_lap_spjpSearch" pasteActions="pasteActions">
			<Components>
				<Hidden id="593" fieldSourceType="DBColumn" dataType="Text" html="False" name="payment_key" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_rep_lap_spjpSearchpayment_key">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="573"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="25" name="t_vat_setllementGrid" connection="ConnSIKP" dataSource="select * from p_survey_question 
WHERE p_survey_type_id=2
order by sequence_no" pageSizeLimit="100" pasteActions="pasteActions">
			<Components>
				<Label id="588" fieldSourceType="DBColumn" dataType="Text" html="False" name="no" fieldSource="sequence_no" PathID="t_vat_setllementGridno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="589" fieldSourceType="DBColumn" dataType="Text" html="False" name="survey_question" fieldSource="survey_question" PathID="t_vat_setllementGridsurvey_question">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<RadioButton id="590" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" html="True" returnValueType="Number" name="pilihan_jawaban" connection="ConnSIKP" dataSource="select p_survey_answer_score_id,score_number from p_survey_answer_score
where p_survey_question_id = 10
ORDER BY score_number desc" boundColumn="p_survey_answer_score_id" textColumn="score_number" PathID="t_vat_setllementGridpilihan_jawaban">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="577" variable="p_survey_question_id" dataType="Integer" parameterType="URL" parameterSource="p_survey_question_id" defaultValue="0"/>
					</SQLParameters>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</RadioButton>
				<Button id="592" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch2" PathID="t_vat_setllementGridButton_DoSearch2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="597"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="583" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_survey_answer_score_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridp_survey_answer_score_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="594" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_survey_question_id" fieldSource="p_survey_question_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridp_survey_question_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="595" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_survey_question_id1" fieldSource="p_survey_question_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridp_survey_question_id1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="585" eventType="Server" id_oncopy="585"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="586" eventType="Server" id_oncopy="586"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="581" styles="Row;AltRow" name="rowStyle" eventType="Server" id_oncopy="587" oldID="587"/>
						<Action actionName="Custom Code" actionCategory="General" id="596"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="313" variable="s_keyword" dataType="Text" parameterType="URL" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_survey_kepuasan_pelanggan_pelaporan_pertanyaan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.php" forShow="True" url="t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="572"/>
			</Actions>
		</Event>
	</Events>
</Page>
